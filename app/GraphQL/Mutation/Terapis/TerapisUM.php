<?php

namespace App\GraphQL\Mutation\Terapis;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Terapis\Models\Terapis;

class TerapisUM extends Mutation
{
    protected $attributes = [
        'name' => 'TerapisUM',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('TerapisT'); 
    }

    public function args()
    {
        return [
            'id'        => ['name'=> 'id', 'type' => Type::int(), 'rule' => ['required']],
            'nama'      => ['name'=> 'nama', 'type' => Type::string()],
            'rating'    => ['name'=> 'rating', 'type' => Type::float()],
            'status'    => ['name'=> 'status', 'type' => Type::boolean()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $terapis = Terapis::findOrFail($args['id']);
        isset($args['nama'])? $terapis->nama = $args['nama']:'';
        isset($args['rating'])? $terapis->rating = $args['rating']:'';
        isset($args['status'])? $terapis->status = $args['status']:'';
        $terapis->save();

        return $terapis;
    }
}
