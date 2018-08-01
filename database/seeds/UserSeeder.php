<?php

use Illuminate\Database\Seeder;
use Thunderlabid\Otorisasi\Models\User;
use Thunderlabid\Otorisasi\Models\Tenant;
use Thunderlabid\Otorisasi\Models\Scope;
use Thunderlabid\Voucher\Models\Voucher;
use Thunderlabid\Voucher\Models\Kepemilikan;

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

        $voucher = Voucher::create([
            'kode' => 'halo123',
            'jenis' => 'diskon',
            'syarat' => 'tidak ada',
            'tanggal_kadaluarsa' => '2018-08-22 13:44:27',
            'owner_id' => $user->username
        ]);

        $pemilik = Kepemilikan::create([
            'tanggal' => '2018-08-22 13:44:27',
            'pemilik' => $voucher->owner_id,
            'id_voucher' => $voucher->id
        ]);
    }
}
