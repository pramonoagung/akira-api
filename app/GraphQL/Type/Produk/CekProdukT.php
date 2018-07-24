<?php

namespace App\GraphQL\Type\Produk;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class CekProdukT extends BaseType
{
    protected $attributes = [
        'name' => 'CekProdukT',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [
            'id' => ['type' => Type::int()],
            'status' => ['type' => Type::string()]
        ];
    }
}
