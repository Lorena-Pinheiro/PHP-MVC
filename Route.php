<?php

class Route{
    protected array $rotas = [];
    protected array $grupos = [];

    public function get($uri, $acao){
        $this->addRota('GET', $uri, $acao);
    }

    public function post($uri, $acao){
        $this->addRota('POST', $uri, $acao);
    }

    public function middleware(array $middlewares){
        $this->grupos = array_merge($this->grupos, $middlewares);
    }

    public function group(callable $callback){
        $antigo = $this->grupos;
        $callback($this);
        $this->grupo = $antigo;
    }

    public function dispatch($metodo, $uri){
        foreach($this->rotas as $rota){
            if($rota['metodo'] !== $metodo) continue;

            [$pattern, $paramNames] = $this->convertToRegex($rota['uri']);

            if(preg_match($pattern, $uri, $matches)){
                array_shift($matches);

                $params = $this->mapeiaParams($paramNames, $matches);

                return $this->execRota($rota, $params);
            }
        }

        http_response_code(404);
    }

    protected function addRota($metodo, $uri, $acao){
        $this->rotas[] = [
            'metodo' => $metodo,
            'uri' => $uri,
            'acao' => $acao,
            'middleware' => $this->grupos
        ];
    }

    protected function convertToRegex($uri){
        $paramNames = [];

        $pattern = preg_replace_callback('/\{(\w+)(\?)?\}/', function($matches) use(&$paramNames){
            $paramNames[] = $matches[1];

            if(isset($matches[2])){
                return '([^/]*)?';
            }

            return '([^/]+)';
        }, $uri);

        return ["#^" . $pattern . "$#", $paramNames];
    }

    protected function mapeiaParams($nomes, $valores){
        $params = [];

        foreach($nomes as $index => $nome){
            $params[$nome] = $valores[$index] ?? null;
        }

        return $params;
    }

    protected function execRota($rota, $params){
        $acao = $rota['acao'];

        $this->execMiddleware($rota['middleware']);

        if(is_callable($acao)){
            return call_user_func_array($acao, $params);
        }

        if(is_array($acao)){
            [$classe, $metodo] = $acao;
            $controller = new $classe;
            return call_user_func_array([$controller, $metodo], $params);
        }
    }

    protected function execMiddleware(array $middlewares){
        foreach($middlewares as $middleware){
            $instance = new $middleware;

            if(method_exists($instance, 'handle')){
                $instance->handle();
            }
        }
    }
}