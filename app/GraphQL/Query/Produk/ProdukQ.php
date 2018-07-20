<?php

namespace App\GraphQL\Query\Produk;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Produk\Models\Produk;

class ProdukQ extends Query
{
    protected $attributes = [
        'name' => 'ProdukQ',
        'description' => 'A query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('ProdukT'));
    }

    public function args()
    {
        return [
            'id' => [
                'type' => Type::int(),
            ],
            'nama' => [
                'type' => Type::string(),
            ],
            'kode' => [
                'type' => Type::string(),
            ],
            'waktu' => [
                'type' => Type::int(),
            ],
            'harga' => [
                'type' => Type::int(),
            ],
            'deskripsi' => [
                'type' => Type::string(),
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        if(isset($args['id'])){
            $produk = Produk::where('id',$args['id'])->get();
        }else{
            $produk = Produk::all();
        }
        return $produk;
    }
}
