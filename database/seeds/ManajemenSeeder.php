<?php

use Illuminate\Database\Seeder;
use Thunderlabid\Manajemen\Models\Karyawan;
use Thunderlabid\Manajemen\Models\KetersediaanTerapis;
use Thunderlabid\Manajemen\Models\Penempatan;
use Thunderlabid\Manajemen\Models\Workshift;
use Thunderlabid\Reservasi\Models\ReservasiHeader as RH;
use Thunderlabid\Reservasi\Models\ReservasiStatus as RS;
use Thunderlabid\Reservasi\Models\ReservasiDetail as RD;

class ManajemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        //Karyawan 1
        $karyawan = Karyawan::create([
            'uuid' => '1888',
            'nip' => '1000000',
            'nama' => 'Tom'
        ]);

        $penempatan = Penempatan::create([
            'posisi' => 'AKIRA-PUSAT',
            'tanggal_mulai' => '2018-08-01 00:00:00',
            'tanggal_berakhir' => '2018-12-01 00:00:00',
            'karyawan_id' => $karyawan->id
        ]);

        $hari = ['senin', 'selasa', 'rabu', 'kamis', 'jumat'];
        foreach($hari as $item){
            $workshift = Workshift::create([
                'hari' => $item,
                'jam_mulai' => '08:00:00',
                'jam_akhir' => '16:00:00',
                'penempatan_id' =>$penempatan->id
            ]);
        }
        foreach($hari as $item){
            $ketersediaanterapis = KetersediaanTerapis::create([
                'hari' => $item,
                'jam_mulai' => $workshift->jam_mulai,
                'jam_akhir' => $workshift->jam_akhir,
                'penempatan_id' =>$penempatan->id
            ]);
        }

        //Karyawan 2
        $karyawan = Karyawan::create([
            'uuid' => '1888',
            'nip' => '1000001',
            'nama' => 'Jerry'
        ]);

        $penempatan = Penempatan::create([
            'posisi' => 'AKIRA-PUSAT',
            'tanggal_mulai' => '2018-08-01 00:00:00',
            'tanggal_berakhir' => '2018-12-01 00:00:00',
            'karyawan_id' => $karyawan->id
        ]);

        $works = ['senin', 'selasa', 'rabu', 'kamis', 'jumat'];
        foreach($works as $item){
            $workshift = Workshift::create([
                'hari' => $item,
                'jam_mulai' => '08:00:00',
                'jam_akhir' => '16:00:00',
                'penempatan_id' =>$penempatan->id
            ]);
        }
        foreach($works as $item){
            $ketersediaanterapis = KetersediaanTerapis::create([
                'hari' => $item,
                'jam_mulai' => $workshift->jam_mulai,
                'jam_akhir' => $workshift->jam_akhir,
                'penempatan_id' =>$penempatan->id
            ]);
        }

        $header = RH::create([
            'tanggal_reservasi' => '2018-07-18 13:44:27',
            'tamu' => 'Adam Levine',
            'kode' => 'WYSIWYG']);

        $status = RS::create([
            'header_reservasi_id' => $header->id,
            'tanggal' => '2018-07-18 13:00:00',
            'status' => 'pending',
            'progress' => 'diterima'
        ]);

        $detail = RD::create([
            'header_reservasi_id' => $header->id,
            'produk_id' => 1,
            'karyawan_id' => 1,
            'jam_berakhir' => "14:00:00"
        ]);
       
        $header = RH::create([
            'tanggal_reservasi' => '2018-07-18 14:00:00',
            'tamu' => 'Farid',
            'kode' => 'ASDF']);

        $status = RS::create([
            'header_reservasi_id' => $header->id,
            'tanggal' => '2018-07-18 13:00:00',
            'status' => 'pending',
            'progress' => 'diterima'
        ]);

        $detail = RD::create([
            'header_reservasi_id' => $header->id,
            'produk_id' => 4,
            'karyawan_id' => 2,
            'jam_berakhir' => "14:00:00"
        ]);
    }
}
