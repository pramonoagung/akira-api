<?php

use Illuminate\Database\Seeder;
use Thunderlabid\Otorisasi\Models\User;
use Thunderlabid\Otorisasi\Models\Tenant;
use Thunderlabid\Otorisasi\Models\Scope;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user 	= User::create(['username' => '089654562911', 'password' => app('hash')->make('123123123')]);
    	$tenant = Tenant::create(['nama' => 'AKIRA']);

    	$default= config()->get('otorisasi.owner.default');
    	foreach ($default as $k => $v) {
    		$scope = Scope::create(['scope' => $v, 'user_id' => $user->id, 'tenant_id' => $tenant->id]);
    	}

        $tenant = Tenant::create(['nama' => 'PANDORA']);
        $scope = Scope::create(['scope' => 'admin', 'user_id' => $user->id, 'tenant_id' => $tenant->id]);
    }
}
