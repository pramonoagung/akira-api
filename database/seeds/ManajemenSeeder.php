<?php

use Illuminate\Database\Seeder;
use Thunderlabid\Manajemen\Models\Karyawan;
use Thunderlabid\Manajemen\Models\KetersediaanTerapis;
use Thunderlabid\Manajemen\Models\Penempatan;
use Thunderlabid\Manajemen\Models\Workshift;

class ManajemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $karyawan = Karyawan::create([
            'uuid' => '1888',
            'nip' => '1111',
            'nama' => 'Tom'
        ]);

        $penempatan = Penempatan::create([
            'posisi' => 'AKIRA-PUSAT',
            'tanggal_mulai' => '2018-08-01 00:00:00',
            'tanggal_berakhir' => '2018-12-01 00:00:00',
            'karyawan_id' => $karyawan->id
        ]);

        $workshift = Workshift::create([
            'hari' => 'senin',
            'jam_mulai' => '08:00:00',
            'jam_akhir' => '16:00:00',
            'penempatan_id' =>$penempatan->id
        ]);

        $ketersediaanterapis = KetersediaanTerapis::create([
            'hari' => $workshift->hari,
            'jam_mulai' => $workshift->jam_mulai,
            'jam_akhir' => $workshift->jam_akhir,
            'penempatan_id' =>$penempatan->id
        ]);
    }
}
