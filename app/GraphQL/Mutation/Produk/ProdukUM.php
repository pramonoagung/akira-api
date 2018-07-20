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
        return Type::listOf(GraphQL::type('ProdukT')); 
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
        $args['nama']? $produk->nama = $args['nama']:'';
        $args['kode']? $produk->kode = $args['kode']:'';
        $args['waktu']? $produk->waktu = $args['waktu']:'';
        $args['harga']? $produk->harga = $args['harga']:'';
        $args['deskripsi']? $produk->deskripsi = $args['deskripsi']:'';
        $produk->save();

        return $produk;
    }
}
