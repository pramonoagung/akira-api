<?php

namespace App\GraphQL\Mutation\Produk;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Produk\Models\Produk;

class ProdukCM extends Mutation
{
    protected $attributes = [
        'name' => 'ProdukCM',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('ProdukT'); 
    }

    public function args()
    {
        return [
            'nama' => ['name'=> 'nama', 'type' => Type::nonNull(Type::string())],
            'waktu' => ['name'=> 'waktu', 'type' => Type::nonNull(Type::int())],
            'harga' => ['name'=> 'harga', 'type' => Type::nonNull(Type::int())],
            'deskripsi' => ['name'=> 'deskripsi', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $produk = new Produk;
        $produk->fill($args);
        $produk->save();
        $inc = 100000 + $produk->id;
        $produk->kode = "PJT".$inc;
        $produk->save();

        return $produk;
    }

}
