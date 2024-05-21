<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/Core/Container.php';
require_once __DIR__ . '/../app/Routes/Router.php';
require_once __DIR__ . '/../app/Config/config.php';

session_set_cookie_params(['httponly' => true]);
session_start();
session_regenerate_id();
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('America/Sao_Paulo');

// Carregar o container
$container = require __DIR__ . '/../app/Routes/container.php';


// Configurar e despachar as rotas
$request = new \App\Core\Request();
$router = new \App\Routes\Router($container);

require_once __DIR__ . '/../app/Routes/web.php';

$response = $router->dispatch($request);
$response->send();