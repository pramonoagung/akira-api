<?php

use Illuminate\Database\Seeder;
use Thunderlabid\About\Models\About;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $about = About::create([
            'nama' => 'AKIRA-PUSAT',
            'alamat' => 'Ruko Puri Niaga A-10 Araya, Pandanwangi, Blimbing, Kota Malang, Jawa Timur 65126',
            'kontak' => '(0341) 2992888']);
    }
}
