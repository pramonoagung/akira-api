<?php

namespace App\GraphQL\Mutation;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL, DB;
use Thunderlabid\Otorisasi\Models\User;

class SignOut extends Mutation
{
    protected $attributes = [
        'name' => 'SignOut',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
        return [
            'username'  => ['name' => 'username',   'type' => Type::string()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $user   = User::username($args['username'])->first();
        
        if (!$user) {
            throw new \Exception("User Doesn't Exist", 999);
        }
        try{
            DB::BeginTransaction();
            $user->device_reg_id = '';
            $user->save();
            DB::Commit();
            return $user;
        }catch(\Exeption $e){
            DB::Rollback();
        }
    }
}
