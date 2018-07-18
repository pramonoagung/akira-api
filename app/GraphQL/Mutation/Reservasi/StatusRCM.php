<?php

namespace App\GraphQL\Mutation\Reservasi;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Reservasi\Models\ReservasiStatus as RS;

class StatusRCM extends Mutation
{
    protected $attributes = [
        'name' => 'StatusRCM',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('ReservasiST');
    }

    public function args()
    {
        return [
            'header_reservasi_id' => ['name' => 'header_reservasi_id', 'type' => Type::int()],
            'tanggal' => ['name' => 'tanggal', 'type' => Type::string()],
            'status' => ['name' => 'status', 'type' => Type::string()],
            'progress' => ['name' => 'progress', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $status = new RS();
        $status->fill($args);
        $status->save();

        return $status;
    }
}
