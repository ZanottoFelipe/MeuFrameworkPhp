<?php

namespace App\Domain\Product;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAll();
    }

    public function getProductById($id)
    {
        return $this->productRepository->findById($id);
    }

    public function createProduct($data)
    {
        $product = new Product($data);
        return $this->productRepository->save($product);
    }

    public function updateProduct($id, $data)
    {
        $product = $this->productRepository->findById($id);
        if ($product) {
            $product->fill($data);
            return $this->productRepository->save($product);
        }

        return null;
    }

    public function deleteProduct($id)
    {
        return $this->productRepository->delete($id);
    }
}
