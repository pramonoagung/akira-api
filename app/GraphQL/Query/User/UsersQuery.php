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
            'username'  => ['name' => 'username', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args)
    {
        if (isset($args['username'])) {
            return User::username($args['username'])->get();
        } else {
            return User::all();
        }
    }
}