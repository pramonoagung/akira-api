<?php

namespace App\GraphQL\Mutation\Reservasi;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Reservasi\Models\ReservasiStatus as RS;

class StatusRDM extends Mutation
{
    protected $attributes = [
        'name' => 'StatusRDM',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('ReservasiST');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $status = RS::findOrFail($args['id']);
        $status->delete();
        return $status;
    }
}
