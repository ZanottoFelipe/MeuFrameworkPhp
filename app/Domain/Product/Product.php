<?php

namespace App\Domain\Product;

class Product
{
    protected $id;
    protected $name;
    protected $description;
    protected $price;
    protected $stock;

    public function __construct($data)
    {
        $this->fill($data);
    }

    public function fill($data)
    {
        $this->name = $data['name'] ?? $this->name;
        $this->description = $data['description'] ?? $this->description;
        $this->price = $data['price'] ?? $this->price;
        $this->stock = $data['stock'] ?? $this->stock;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock
        ];
    }

    // Métodos getters e setters
}
