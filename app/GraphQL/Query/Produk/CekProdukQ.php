<?php

namespace App\GraphQL\Query\Produk;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Produk\Models\Produk;
use App\Events\CekProdukEvent;

class CekProdukQ extends Query
{
    protected $attributes = [
        'name' => 'CekProdukQ',
        'description' => 'A query'
    ];

    public function type()
    {
        return GraphQL::type('CekProdukT');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $cekProduk = event(new CekProdukEvent($args['id']));
        if($cekProduk){
            return ['id' => $args['id'], 'status' => 'Tersedia'];
        }else{
            dd('boo');
            return ['id' => $args['id'], 'status' => 'Tidak Tersedia'];
        }
    }
}
