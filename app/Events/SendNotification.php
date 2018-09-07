<?php

namespace App\Events;

class SendNotification extends Event
{
    public $token;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(String $token)
    {
        $this->token = $token;        
    }
 
}
