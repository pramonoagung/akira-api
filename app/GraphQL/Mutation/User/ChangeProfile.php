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
            'id'        => ['name' => 'id',       'type' => Type::string()],
            'username'  => ['name' => 'username',       'type' => Type::string()],
            'nama'      => ['name' => 'nama',       'type' => Type::string()]
        ];
    }
    
    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $user = User::find($args['id']);
        if(isset($args['username']) && !isset($args['nama'])){
            $user->username = $args['username'];
        }
        elseif(isset($args['nama']) && !isset($args['username'])){
            $user->nama = $args['nama'];
        }else{
            $user->username = $args['username'];
            $user->nama = $args['nama'];
        }
        $user->save();
        return $user;
    }
}
