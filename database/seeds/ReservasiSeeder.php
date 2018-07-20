<?php

use Illuminate\Database\Seeder;
use Thunderlabid\Reservasi\Models\ReservasiHeader as RH;
use Thunderlabid\Reservasi\Models\ReservasiStatus as RS;
use Thunderlabid\Reservasi\Models\ReservasiDetail as RD;

class ReservasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $header = RH::create([
            'tanggal_reservasi' => '2018-07-18 13:44:27',
            'tamu' => 'Adam Levine',
            'kode' => 'WYSIWYG']);

        $status = RS::create([
            'header_reservasi_id' => $header->id,
            'tanggal' => '2018-07-18 13:44:27',
            'status' => 'Diterima',
            'progress' => 'Diverivikasi'
        ]);

        $detail = RD::create([
            'header_reservasi_id' => $header->id,
            'durasi' => '30',
            'produk' => 'Totok Wajah',
            'terapis' => 'Bu Ijah'
        ]);
    }
}
