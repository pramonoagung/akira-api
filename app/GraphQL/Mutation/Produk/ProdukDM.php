<?php

namespace App\GraphQL\Mutation\Produk;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Produk\Models\Produk;

class ProdukDM extends Mutation
{
    protected $attributes = [
        'name' => 'ProdukDM',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('ProdukT');
    }

    public function args()
    {
        return [
            'id'    => ['name'=> 'id', 'type' => Type::int(), 'rule' => ['required']]  
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $produk = Produk::findOrFail($args['id']);
        $produk->delete();
        return $produk;
    }
}
