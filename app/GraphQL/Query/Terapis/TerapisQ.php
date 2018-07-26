<?php

namespace App\GraphQL\Query\Terapis;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Terapis\Models\Terapis;

class TerapisQ extends Query
{
    protected $attributes = [
        'name' => 'CekTerapisQ',
        'description' => 'A query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('TerapisT'));
    }

    public function args()
    {
        return [
            'id' => [
                'type' => Type::int(),
            ],
            'nama' => [
                'type' => Type::string(),
            ],
            'status' => [
                'type' => Type::string(),
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        if(isset($args['id'])){
            return Terapis::where('id', $args['id'])->get();
        }else{
            return Terapis::all();
        }
    }
}
