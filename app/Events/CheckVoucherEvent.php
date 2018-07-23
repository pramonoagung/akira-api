<?php

namespace App\Events;

use Thunderlabid\Pembayaran\Models\Pembayaran;

class CheckVoucherEvent extends Event
{
    public $referensi;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Pembayaran $referensi)
    {
        //dd('here');
        $this->referensi = $referensi;
        
    }
 
}
