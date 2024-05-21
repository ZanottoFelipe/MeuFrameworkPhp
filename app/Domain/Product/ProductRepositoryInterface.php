<?php

namespace App\Domain\Product;

interface ProductRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function save(Product $product);
    public function delete($id);
}
