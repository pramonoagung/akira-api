<?php

use Illuminate\Database\Seeder;
use Thunderlabid\Terapis\Models\Terapis;

class TerapisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $terapis = Terapis::create([
            'nama' => 'Mpok Ijah',
            'status' => true]);
        $terapis = Terapis::create([
            'nama' => 'Mpok Sumi',
            'status' => false]);
        $terapis = Terapis::create([
            'nama' => 'Pak Sutris',
            'status' => true]);
    }
}
