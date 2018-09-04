<?php

namespace App\GraphQL\Mutation\User;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL, DB;
use Thunderlabid\Otorisasi\Models\User;
use Thunderlabid\Otorisasi\Models\Scope;
use Thunderlabid\Otorisasi\Models\Tenant;

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
            'id'        => ['name' => 'id',       'type' => Type::int()],
            'nama'      => ['name' => 'nama',       'type' => Type::string()],
            'username'  => ['name' => 'username',   'type' => Type::string()],
            'scope'     => ['name' => 'scope',   'type' => Type::string()],
            'tenant'    => ['name' => 'tenant',   'type' => Type::string()],
            'jk'        => ['name' => 'jk',   'type' => Type::string()],
            'password'  => ['name' => 'password',   'type' => Type::string()]
        ];
    }
    
    public function resolve($root, $args, $context, ResolveInfo $info){
        $user = User::findOrFail($args['id']);
        if (!$user) {
            throw new \Exception("User Doesn't Exist", 999);
        }
        
        if(isset($args['scope'])){
            return $this->updateAdmin($args,$user);
        }else{
            return $this->updateUser($args);
        }
    }
    
    private function updateAdmin($args, $user){
        $args['tenant']     = 'AKIRA';
        try {
            DB::BeginTransaction();
            isset($args['username'])? $user->username      = $args['username']:'';
            isset($args['nama'])    ? $user->nama          = $args['nama']:'';
            $user->save();
            
            $scope = Scope::FindOrFail($user['id']);
            isset($args['scope'])? $scope->scope = $args['scope']:'';
            $scope->save();          
            
            DB::Commit();
            return $user;
        }catch(\Exeption $e){
            DB::Rollback();
        }
    }
    
    private function updateUser($args){
        try{
            DB::BeginTransaction();
            $user   = new User;
            $user->username     = $args['username'];
            $user->nama         = $args['nama'];
            $user->jenis_kelamin= $args['jk'];
            $user->password     = app('hash')->make($args['password']);
            $user->save();
            DB::Commit();
            return $user;
        }catch(\Exeption $e){
            DB::Rollback();
        }
    }      
}
    