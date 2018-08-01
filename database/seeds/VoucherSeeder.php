<?php

use Illuminate\Database\Seeder;
use Thunderlabid\Voucher\Models\Voucher;
use Thunderlabid\Voucher\Models\Kepemilikan;
use Thunderlabid\Otorisasi\Models\User;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $user = User::find(['id'])->first();
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
