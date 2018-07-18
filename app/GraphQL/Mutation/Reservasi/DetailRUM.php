<?php

namespace App\GraphQL\Mutation\Reservasi;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Reservasi\Models\ReservasiDetail as RD;

class DetailRUM extends Mutation
{
    protected $attributes = [
        'name' => 'DetailRUM',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('ReservasiDT');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'header_reservasi_id' => ['name' => 'header_reservasi_id', 'type' => Type::int()],
            'durasi' => ['name' => 'durasi', 'type' => Type::string()],
            'produk' => ['name' => 'produk', 'type' => Type::string()],
            'terapis' => ['name' => 'terapis', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $detail = RD::findOrFail($args['id']);
        $args['header_reservasi_id']? $detail->header_reservasi_id=$args['header_reservasi_id']:'';
        $args['durasi']? $detail->durasi=$args['durasi']:'';
        $args['produk']? $detail->produk=$args['produk']:'';
        $args['terapis']? $detail->terapis=$args['terapis']:'';
        $detail->save();

        return $detail;
    }
}
