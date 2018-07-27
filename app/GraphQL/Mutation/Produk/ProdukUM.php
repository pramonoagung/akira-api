<?php

namespace App\GraphQL\Mutation\Produk;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Produk\Models\Produk;

class ProdukUM extends Mutation
{
    protected $attributes = [
        'name' => 'ProdukUM',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('ProdukT'); 
    }

    public function args()
    {
        return [
            'id'        => ['name'=> 'id', 'type' => Type::nonNull(Type::int())],
            'nama'      => ['name'=> 'nama', 'type' => Type::string()],
            'kode'      => ['name'=> 'kode', 'type' => Type::string()],
            'waktu'     => ['name'=> 'waktu', 'type' => Type::int()],
            'harga'     => ['name'=> 'harga', 'type' => Type::int()],
            'deskripsi' => ['name'=> 'deskripsi', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $produk = Produk::findOrFail($args['id']);
        isset($args['nama'])? $produk->nama = $args['nama']:'';
        isset($args['kode'])? $produk->kode = $args['kode']:'';
        isset($args['waktu'])? $produk->waktu = $args['waktu']:'';
        isset($args['harga'])? $produk->harga = $args['harga']:'';
        isset($args['deskripsi'])? $produk->deskripsi = $args['deskripsi']:'';
        $produk->save();

        return $produk;
    }
}
