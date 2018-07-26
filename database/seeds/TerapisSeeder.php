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
            'rating' => 4.5,
            'status' => true]);
        $terapis = Terapis::create([
            'nama' => 'Mpok Sumi',
            'rating' => 4,
            'status' => false]);
        $terapis = Terapis::create([
            'nama' => 'Pak Sutris',
            'rating' => 4.3,
            'status' => true]);
    }
}
