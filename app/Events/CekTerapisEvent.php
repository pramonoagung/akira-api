<?php

namespace App\Events;

class CekTerapisEvent extends Event
{

    public $cek;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(String $terapis)
    {
        $this->cek = $terapis;
    }
}
