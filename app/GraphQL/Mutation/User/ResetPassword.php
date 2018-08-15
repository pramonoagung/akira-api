<?php

namespace App\GraphQL\Mutation\User;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Illuminate\Support\Facades\Hash;
use Thunderlabid\Otorisasi\Models\User;

class ResetPassword extends Mutation
{
    protected $attributes = [
        'name' => 'ResetPassword',
        'description' => 'A mutation'
    ];
    
    public function type()
    {
        return GraphQL::type('User');
    }
    
    public function args()
    {
        return [
            'id'            => ['name' => 'id',       'type' => Type::nonNull(Type::int())],
            'password'      => ['name' => 'password',       'type' => Type::nonNull(Type::string())],
            'new_password'      => ['name' => 'new_password',       'type' => Type::nonNull(Type::string())]
        ];
    }
    
    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $user = User::find($args['id']);
        if(Hash::check($args['password'], $user->password)){
            $user->password = app('hash')->make($args['new_password']);
            $user->save();
            return $user;    
        }   
        else{
            return response('The Password doesnt match', 500);
        }     
        
    }
}
