<?php

namespace App\Events;

class CheckVoucherEvent extends Event
{
    public $kode;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(String $kode)
    {
        //dd('here');
        $this->kode = $kode;
        
    }
 
}
