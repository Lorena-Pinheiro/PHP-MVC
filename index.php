<?php
session_start();
require_once 'app/config/config.php';
require_once 'app/rotas/Route.php';
require_once 'app/helpers/view.php';
require_once 'app/helpers/print.php';
require_once 'app/rotas/rotas.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$router->dispatch($method, $uri);