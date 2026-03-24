<?php
require_once 'Route.php';
require_once 'helper.php';
require_once 'rotas.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$router->dispatch($method, $uri);