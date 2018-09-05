<?php

namespace App\GraphQL\Mutation\User;

use GraphQL, DB;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Otorisasi\Models\User;
use Thunderlabid\Otorisasi\Models\Scope;
use Thunderlabid\Otorisasi\Models\Tenant;

class AddUser extends Mutation
{
    protected $attributes = [
        'name' => 'AddUser'
    ];
    
    public function type()
    {
        return GraphQL::type('User');
    }
    
    public function args()
    {
        return [
            'nama'      => ['name' => 'nama',       'type' => Type::string()],
            'username'  => ['name' => 'username',   'type' => Type::string()],
            'scope'     => ['name' => 'scope',   'type' => Type::string()],
            'token'     => ['name' => 'token',   'type' => Type::string()],
            'tenant'    => ['name' => 'tenant',   'type' => Type::string()],
            'jk'        => ['name' => 'jk',   'type' => Type::string()],
            'password'  => ['name' => 'password',   'type' => Type::string()]
        ];
    }
    
    public function resolve($root, $args)
    {
        $user   = User::username($args['username'])->first();
        
        if ($user) {
            throw new \Exception("User Exists", 999);
        }else if(isset($args['scope'])){
            return $this->createAdmin($args);
        }else{
            return $this->createUser($args);
        }
        
    }
    
    private function createAdmin($args){
        $args['password']   = 'newadmin';
        $args['tenant']     = 'AKIRA';
        try{
            DB::BeginTransaction();
            $user   = new User;
            $user->username      = $args['username'];
            $user->nama          = $args['nama'];
            $user->password      = app('hash')->make($args['password']);
            $user->save();

            $tenant = new Tenant;
            $tenant->nama        = $args['tenant'];
            $tenant->save();
            
            $scope = new Scope;
            $scope->scope        = $args['scope'];
            $scope->user_id      = $user->id;
            $scope->tenant_id    = $tenant->id;
            $scope->save();
            DB::Commit();
            return $user;
        }catch(\Exeption $e){
            DB::Rollback();
        }
    }
    private function createUser($args){
        try{
            DB::BeginTransaction();
            $user   = new User;
            $user->username     = $args['username'];
            $user->nama         = $args['nama'];
            $user->jenis_kelamin= $args['jk'];
            $user->device_reg_id= $args['token'];
            $user->password     = app('hash')->make($args['password']);
            $user->save();
            DB::Commit();
            return $user;
        }catch(\Exeption $e){
            DB::Rollback();
        }
    }
}