<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('UserSeeder');
        $this->call('ReservasiSeeder');
        $this->call('ProdukSeeder');
        $this->call('TerapisSeeder');
        $this->call('TransaksiSeeder');
        $this->call('ManajemenSeeder'); 
        $this->call('AboutSeeder');   
    }
}
