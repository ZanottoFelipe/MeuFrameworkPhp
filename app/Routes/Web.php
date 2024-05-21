<?php
namespace App\Routes;

use App\Application\Controllers\HomeController;
use App\Application\Controllers\UserController;
use App\Application\Controllers\ProductController;
use App\FiltersMiddleware\AuthenticateMiddleware;
use App\Routes\Router;

$router = new Router($container);

$router->get('', [AuthenticateMiddleware::class, 'handle'], [HomeController::class, 'index']);
$router->get('home', [AuthenticateMiddleware::class, 'handle'], [HomeController::class, 'index']);
$router->get('users', [AuthenticateMiddleware::class, 'handle'], [UserController::class, 'index']);
$router->post('users', [AuthenticateMiddleware::class, 'handle'], [UserController::class, 'store']);
$router->get('users/{id}', [AuthenticateMiddleware::class, 'handle'], [UserController::class, 'show']);
$router->put('users/{id}', [AuthenticateMiddleware::class, 'handle'], [UserController::class, 'update']);
$router->delete('users/{id}', [AuthenticateMiddleware::class, 'handle'], [UserController::class, 'destroy']);

$router->get('product', [AuthenticateMiddleware::class, 'handle'], [ProductController::class, 'index']);
$router->post('product', [AuthenticateMiddleware::class, 'handle'], [ProductController::class, 'store']);
$router->get('product/{id}', [AuthenticateMiddleware::class, 'handle'], [ProductController::class, 'show']);
$router->put('product/{id}', [AuthenticateMiddleware::class, 'handle'], [ProductController::class, 'update']);
$router->delete('product/{id}', [AuthenticateMiddleware::class, 'handle'], [ProductController::class, 'destroy']);