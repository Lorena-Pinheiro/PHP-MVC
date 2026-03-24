<?php
$router = new Route();
$router->get('/teste', function () {
    echo 'Hello World <button><a href="/">Teste</a></button>';
});

$router->get('/', function () {
    return view("teste", ['teste'=>'asdf']);
});