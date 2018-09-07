<?php

namespace App\Events;

class SendNotification extends Event
{
    public $token, $pesan;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(String $token, String $pesan)
    {
        $this->token = $token;
        $this->pesan = $pesan;
    }
 
}
