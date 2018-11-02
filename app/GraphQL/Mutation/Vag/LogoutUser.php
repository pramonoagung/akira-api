<?php

namespace App\GraphQL\Mutation\Vag;

use GraphQL, DB;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Otorisasi\Models\User;

class LogoutUser extends Mutation
{
    protected $attributes = [
        'name' => 'LogoutUser'
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
    
    public function resolve($root, $args)
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