<?php

namespace App\GraphQL\Mutation\User;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

use Thunderlabid\Otorisasi\Models\User;
use Thunderlabid\Otorisasi\Models\Scope;
use Thunderlabid\Otorisasi\Models\Tenant;

class RemoveOrganization extends Mutation
{
    protected $attributes = [
        'name' => 'RemoveOrganization'
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
        return [
            'owner'     => ['name' => 'owner',  'type' => Type::listOf(GraphQL::type('IUser'))],
            'uuid'      => ['name' => 'uuid',   'type' => Type::string()]
        ];
    }

    public function resolve($root, $args)
    {
        $user   = User::username($args['owner'][0]['username'])->first();

        if (!$user) {
            throw new \Exception("User not found", 999);
        }

        $tenant = Tenant::where('uuid', $args['uuid'])->first();
        $scopes = Scope::where('user_id', $user->id)->where('tenant_id', $tenant->id)->delete();
        $tenant->delete();

        return $user;
    }
}