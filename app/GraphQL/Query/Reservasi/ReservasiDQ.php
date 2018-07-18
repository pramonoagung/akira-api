<?php

namespace App\GraphQL\Query\Reservasi;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Reservasi\Models\ReservasiDetail as RD;

class ReservasiDQ extends Query
{
    protected $attributes = [
        'name' => 'ReservasiDQ',
        'description' => 'A query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('ReservasiDT'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'durasi' => ['name' => 'durasi', 'type' => Type::string()],
            'produk' => ['name' => 'produk', 'type' => Type::string()],
            'terapis' => ['name' => 'terapis', 'type' => Type::string()],
            'header_reservasi_id' => ['name' => 'header_reservasi_id', 'type' => Type::int()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        if(isset($args['id'])){
            return RD::findOrFail($args['id']);
        }elseif(isset($args['header_reservasi_id'])){
            return RD::where('header_reservasi_id', $args['header_reservasi_id'])->get();
        }else{
            return RD::all();
        }
    }
}
