<?php
session_start();

require_once 'rotas/Route.php';
require_once 'helpers/view.php';
require_once 'helpers/print.php';
require_once 'rotas/rotas.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$router->dispatch($method, $uri);