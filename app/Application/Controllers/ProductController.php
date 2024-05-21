<?php

namespace App\Application\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Domain\Product\ProductService;
use App\Core\View;

class ProductController
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
        $view = new View(__DIR__ . '/../../../resources/views/comun/product/index.php', ['products' => $products]);
        $html = $view->render();
        return new Response($html, 200);
    }

    public function store(Request $request)
    {
        $data = $request->getBody();
        $product = $this->productService->createProduct($data);
        return new Response(json_encode($product), 201, ['Content-Type' => 'application/json']);
    }

    public function show(Request $request, $id)
    {
        $product = $this->productService->getProductById($id);
        if ($product) {
            return new Response(json_encode($product), 200, ['Content-Type' => 'application/json']);
        }
        return new Response('Product not found', 404);
    }

    public function update(Request $request, $id)
    {
        $data = $request->getBody();
        $product = $this->productService->updateProduct($id, $data);
        return new Response(json_encode($product), 200, ['Content-Type' => 'application/json']);
    }

    public function destroy(Request $request, $id)
    {
        $this->productService->deleteProduct($id);
        return new Response('Product deleted', 200);
    }
}
