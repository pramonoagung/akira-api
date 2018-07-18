<?php

namespace App\GraphQL\Mutation\Reservasi;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Reservasi\Models\ReservasiDetail as RD;

class DetailRDM extends Mutation
{
    protected $attributes = [
        'name' => 'DetailRDM',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('ReservasiDT');
    }

    public function args()
    {
        return [
            'id' => ['name'=>'id', 'type'=>Type::int()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $detail = RD::findOrFail($args['id']);
        $detail->delete();

        return $detail;
    }
}
