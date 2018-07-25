<?php

namespace App\GraphQL\Mutation\User;

use GraphQL, Auth;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;

use Thunderlabid\Otorisasi\Models\User;
use Thunderlabid\Otorisasi\Models\Scope;
use Thunderlabid\Otorisasi\Models\Tenant;

class AddOrganization extends Mutation
{
    protected $attributes = [
        'name' => 'AddOrganization'
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
            'owner'     => ['name' => 'owner',  'type' => Type::listOf(GraphQL::type('IUser'))],
            'nama'      => ['name' => 'nama',   'type' => Type::string()],
            // 'uuid'      => ['name' => 'uuid',   'type' => Type::string()]
        ];
    }

    public function resolve($root, $args)
    {
        $user   = User::username($args['owner'][0]['username'])->first();

        if (!$user) {
            throw new \Exception("User not found", 999);
        }

        // $tenant            = Tenant::where('uuid', $args['uuid'])->first();

        // if ($tenant) {
        //     throw new \Exception("Organization already exists", 999);
        // }

        $tenant             = new Tenant;
        $tenant->nama       = $args['nama'];
        $tenant->save();

        $default= config()->get('otorisasi.owner.default');
        foreach ($default as $k => $v) {
            $scope = Scope::create(['scope' => $v, 'user_id' => $user->id, 'tenant_id' => $tenant->id]);
        }

        return $user;
    }
}