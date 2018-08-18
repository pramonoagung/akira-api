<?php

namespace App\GraphQL\Mutation\Reservasi;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Thunderlabid\Reservasi\Models\ReservasiDetail as RD;
use GraphQL;

class BatalReservasi extends Mutation
{
    protected $attributes = [
        'name' => 'BatalReservasi',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('ReservasiHT');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $reservasi = RD::find($args['id']);
        $reservasi->delete();
        return $reservasi;
    }
}
