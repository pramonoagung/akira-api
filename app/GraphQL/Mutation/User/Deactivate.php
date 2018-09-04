<?php

namespace App\GraphQL\Mutation\User;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use Thunderlabid\Otorisasi\Models\User;

class Deactivate extends Mutation
{
    protected $attributes = [
        'name' => 'Deactivate'
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
        return [
            'username'      =>  [
                                    'type'          => Type::string(),
                                    'rules'         => ['nullable']
                                ],
        ];
    }

    public function resolve($root, $args)
    {
        $old    = User::username($args['username'])->first();
        $user   = User::username($args['username'])->delete();

        return $old;
    }
}