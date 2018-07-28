<?php

use Illuminate\Database\Seeder;
use Thunderlabid\Pembayaran\Models\HeaderTransaksi;
use Thunderlabid\Pembayaran\Models\DetailTransaksi;
use Thunderlabid\Pembayaran\Models\Pembayaran;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $header = HeaderTransaksi::create([
            'nomor' => '1008',
            'tanggal' => '2018-07-18 13:44:27'
        ]);

        $detail = DetailTransaksi::create([
            'ref_id'=> '2008',
            'produk' => 'Totok Wajah',
            'kuantitas' => '1',
            'harga' => '10000',
            'diskon' => '0',
            'id_header_transaksi' => $header->id

        ]);

        $pembayaran = Pembayaran::create([
            'jenis' => 'Voucher',
            'jumlah' => '100000',
            'referensi' => 'halo123',
            'id_header_transaksi' => $header->id
        ]);
    }
}
