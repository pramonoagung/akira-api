<?php

namespace App\GraphQL\Query\User;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Thunderlabid\Otorisasi\Models\User;

class UsersQuery extends Query
{
    protected $attributes = [
        'name' => 'users'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('User'));
    }

    public function args()
    {
        return [
            'id'  => ['name' => 'id', 'type' => Type::int()]
        ];
    }

    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            //return User::username($args['username'])->get();
            return User::where('id',$args['id'])->get();
        } else {
            return User::all();
        }
    }
}