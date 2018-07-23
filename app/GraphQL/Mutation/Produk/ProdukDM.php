<?php

namespace App\GraphQL\Mutation\Produk;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

class ProdukDM extends Mutation
{
    protected $attributes = [
        'name' => 'ProdukDM',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return Type::listOf(Type::string());
    }

    public function args()
    {
        return [
            
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        return [];
    }
}
