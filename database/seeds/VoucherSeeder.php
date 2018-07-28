<?php

use Illuminate\Database\Seeder;
use Thunderlabid\Voucher\Models\Voucher;
use Thunderlabid\Voucher\Models\Kepemilikan;
class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $voucher = Voucher::create([
            'kode' => 'halo123',
            'jenis' => 'diskon',
            'syarat' => 'tidak ada',
            'tanggal_kadaluarsa' => '2018-08-22 13:44:27'
        ]);

        $pemilik = Kepemilikan::create([
            'tanggal' => '2018-08-22 13:44:27',
            'pemilik' => 'ardian',
            'id_voucher' => $voucher->id
        ]);
    }
}
