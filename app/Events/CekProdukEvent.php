<?php

namespace App\Events;

class CekProdukEvent extends Event
{

    public $cek;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(String $produkId)
    {
        $this->cek = $produkId;
    }
}
