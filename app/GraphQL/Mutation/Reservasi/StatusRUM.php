<?php

namespace App\GraphQL\Mutation\Reservasi;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Reservasi\Models\ReservasiStatus as RS;

class StatusRUM extends Mutation
{
    protected $attributes = [
        'name' => 'StatusRUM',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('ReservasiST');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'header_reservasi_id' => ['name' => 'header_reservasi_id', 'type' => Type::int()],
            'tanggal' => ['name' => 'tanggal', 'type' => Type::string()],
            'status' => ['name' => 'status', 'type' => Type::string()],
            'progress' => ['name' => 'progress', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $status = RS::findOrFail($args['id']);
        $args['header_reservasi_id']? $status->header_reservasi_id=$args['header_reservasi_id']:'';
        $args['tanggal']? $status->tanggal=$args['tanggal']:'';
        $args['status']? $status->status=$args['status']:'';
        $args['progress']? $status->progress=$args['progress']:'';
        $status->save();

        return $status;
    }
}
