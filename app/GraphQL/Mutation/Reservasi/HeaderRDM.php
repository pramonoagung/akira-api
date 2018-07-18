<?php

namespace App\GraphQL\Mutation\Reservasi;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Reservasi\Models\ReservasiHeader;

class HeaderRDM extends Mutation
{
    protected $attributes = [
        'name' => 'HeaderRDM',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('ReservasiHT');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $header = ReservasiHeader::findOrFail($args['id']);
        $header->delete();
        return $header;
    }
}
