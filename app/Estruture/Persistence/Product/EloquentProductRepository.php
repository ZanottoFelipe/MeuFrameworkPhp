<?php

namespace App\Estruture\Persistence\Product;

use App\Domain\Product\Product;
use App\Domain\Product\ProductRepositoryInterface;

class EloquentProductRepository implements ProductRepositoryInterface
{
    protected $model;

    public function __construct(ProductModel $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function save(Product $product)
    {
        $productModel = $this->model->find($product->id) ?? new ProductModel();
        $productModel->fill($product->toArray());
        $productModel->save();
        return $productModel;
    }

    public function delete($id)
    {
        $productModel = $this->model->find($id);
        if ($productModel) {
            $productModel->delete();
            return true;
        }
        return false;
    }
}
