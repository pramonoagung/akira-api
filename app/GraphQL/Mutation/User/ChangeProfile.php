<?php

namespace App\GraphQL\Mutation\User;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Otorisasi\Models\User;

class ChangeProfile extends Mutation
{
    protected $attributes = [
        'name' => 'ChangeProfile',
        'description' => 'A mutation'
    ];
    
    public function type()
    {
        return GraphQL::type('User');
    }
    
    public function args()
    {
        return [
            'username'  => ['name' => 'username',       'type' => Type::nonNull(Type::string())],
            'nama'      => ['name' => 'nama',       'type' => Type::nonNull(Type::string())]
        ];
    }
    
    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $user = User::where('username', $args['username'])->first();
        $user->nama = $args['nama'];
        $user->save();
        return $user;
    }
}
