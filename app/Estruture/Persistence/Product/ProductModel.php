<?php

namespace App\Estruture\Persistence\Product;

use App\Estruture\Persistence\ORM\Model;

class ProductModel extends Model
{
    protected $table = 'produtos';
    protected $primaryKey = 'id';
    protected $fillable = ['nome', 'descricao', 'preco', 'estoque','categoria'];
    protected $attributes = [
        'nome' => '',
        'descricao' => '',
        'preco' => 0,
        'estoque' => 0,
        'categoria' => 0

    ];
}
