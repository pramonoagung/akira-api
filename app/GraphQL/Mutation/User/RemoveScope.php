<?php

namespace App\GraphQL\Mutation\User;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

use Thunderlabid\Otorisasi\Models\User;
use Thunderlabid\Otorisasi\Models\Scope;
use Thunderlabid\Otorisasi\Models\Tenant;

class RemoveScope extends Mutation
{
    protected $attributes = [
        'name' => 'RemoveScope'
    ];

    public function type()
    {
        return GraphQL::type('User');
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

        $tenant = Tenant::where('uuid', $args['organization'][0]['uuid'])->first();

        if (!$tenant) {
            throw new \Exception("Organization not found", 999);
        }

        $scopes = Scope::where('user_id', $user->id)->where('tenant_id', $tenant->id)->where('scope', $args['scope'])->delete();

        return $user;
    }
}