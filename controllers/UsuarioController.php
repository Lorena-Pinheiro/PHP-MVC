<?php 
require_once __DIR__ . '/../services/UsuarioService.php';

class UsuarioController{
    private $usuarioService;

    public function __construct(){
        $this->usuarioService = new UsuarioService();
    }

    public function login($username, $senha){
        try{
            $result = $this->usuarioService->login($username, password_hash($senha, PASSWORD_DEFAULT));
            // return Ok($result);
            view('profile', ['result'=> $result]);
        }catch (Exception $e){
            var_dump($e);
        }
        // echo '<button><a href="/teste">Voltar</a></button>';
    }
}