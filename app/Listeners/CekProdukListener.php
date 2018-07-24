<?php

namespace App\Listeners;

use App\Events\CekProdukEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Thunderlabid\Produk\Models\Produk;

class CekProdukListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CekTerapisEvent  $event
     * @return void
     */
    public function handle(CekProdukEvent $event)
    {
        $produkId= (int) $event->cek;
        $produk = Produk::where('id', $produkId)->first();
        if($produk){
            return true;
        } else{
            return false;
        }
    }
}
