<?php

namespace App\GraphQL\Mutation\User;

use GraphQL, Auth;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

use Thunderlabid\Otorisasi\Models\User;
use Thunderlabid\Otorisasi\Models\Scope;
use Thunderlabid\Otorisasi\Models\Tenant;

class AddScope extends Mutation
{
    protected $attributes = [
        'name' => 'AddScope'
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function authorize($root, $args)
    {
        //1. kalau tidak login tolak request
        if(!Auth::check()){
            return false;
        }
        //2. kalau login terima request
        return true;
    }

    public function args()
    {
        return [
            'user'          =>  [
                                    'type'          => Type::listOf(GraphQL::type('IUser')),
                                    'rules'         => ['nullable']
                                ],
            'organization'  =>  [
                                    'type'          => Type::listOf(GraphQL::type('IUserOrganization')),
                                    'rules'         => ['nullable']
                                ],
            'scope'         =>  [
                                    'type'          => Type::string(),
                                    'rules'         => ['nullable']
                                ],
        ];
    }

    public function resolve($root, $args)
    {
        $user   = User::username($args['user'][0]['username'])->first();

        if (!$user) {
            throw new \Exception("User not found", 999);
        }

        $tenant            = Tenant::where('uuid', $args['organization'][0]['uuid'])->first();

        if (!$tenant) {
            throw new \Exception("Tenant not found", 999);
        }

        $scope              = new Scope;
        $scope->scope       = $args['scope']; 
        $scope->user_id     = $user->id; 
        $scope->tenant_id   = $tenant->id; 
        $scope->save();

        return $user;
    }
}