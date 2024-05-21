<?php
namespace App\Routes;

use App\Application\Controllers\HomeController;
use App\Application\Controllers\UserController;
use App\Application\Controllers\ProductController;
use App\FiltersMiddleware\AuthenticateMiddleware;
use App\Core\Container;
use App\Domain\User\UserService;
use App\Domain\User\UserRepositoryInterface;
use App\Domain\Product\ProductService;
use App\Domain\Product\ProductRepositoryInterface;
use App\Estruture\Persistence\User\EloquentUserRepository;
use App\Estruture\Persistence\User\UserModel;
use App\Estruture\Persistence\Product\EloquentProductRepository;
use App\Estruture\Persistence\Product\ProductModel;
use App\Routes\Router;

$container = new Container();

// Bind controllers
$container->bind(HomeController::class, HomeController::class);
$container->bind(UserController::class, UserController::class);
$container->bind(ProductController::class, ProductController::class);
$container->bind(AuthenticateMiddleware::class, AuthenticateMiddleware::class);

// Bind models
$container->bind(UserModel::class, UserModel::class);
$container->bind(ProductModel::class, ProductModel::class);

// Bind repositories
$container->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
$container->bind(ProductRepositoryInterface::class, EloquentProductRepository::class);

// Bind services
$container->bind(UserService::class, function ($container) {
    return new UserService($container->make(UserRepositoryInterface::class));
});

$container->bind(ProductService::class, function ($container) {
    return new ProductService($container->make(ProductRepositoryInterface::class));
});


return $container;
