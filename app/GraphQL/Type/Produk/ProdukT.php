<?php

namespace App\GraphQL\Type\Produk;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class ProdukT extends BaseType
{
    protected $attributes = [
        'name' => 'ProdukT',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'nama' => [
                'type' => Type::nonNull(Type::string()),
            ],
            'kode' => [
                'type' => Type::nonNull(Type::string()),
            ],
            'waktu' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'harga' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'deskripsi' => [
                'type' => Type::string(),
            ],
            
        ];
    }
}
