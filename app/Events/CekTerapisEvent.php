<?php

namespace App\Events;

class CekTerapisEvent extends Event
{

    public $hari, $tanggal, $jam;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(String $hari, String $tanggal)
    {
        $this->hari = $hari;
        $this->tanggal = $tanggal;
    }
}
