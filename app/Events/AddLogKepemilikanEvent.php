<?php

namespace App\Events;

class AddLogKepemilikanEvent extends Event
{

    public $cek;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $username, int $id)
    {
        // dd($id);
        $this->username = $username ;
        $this->id = $id;
    }
}
