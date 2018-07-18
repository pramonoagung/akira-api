<?php

namespace App\GraphQL\Mutation\Reservasi;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Reservasi\Models\ReservasiDetail as RD;

class DetailRCM extends Mutation
{
    protected $attributes = [
        'name' => 'DetailRCM',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('ReservasiDT');
    }

    public function args()
    {
        return [
            'header_reservasi_id' => ['name' => 'header_reservasi_id', 'type' => Type::int()],
            'durasi' => ['name' => 'durasi', 'type' => Type::string()],
            'produk' => ['name' => 'produk', 'type' => Type::string()],
            'terapis' => ['name' => 'terapis', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $detail = new RD();
        $detail->fill($args);
        $detail->save();

        return $detail;
    }
}
