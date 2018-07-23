<?php

namespace App\Listeners;

use App\Events\CekTerapisEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Thunderlabid\Terapis\Models\Terapis;

class CekTerapisListener
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
    public function handle(CekTerapisEvent $event)
    {
        $terapisId= (int) $event->cek;
        $terapis = Terapis::where('id', $terapisId)->first();
        if($terapis['status']){
            return true;
        } else{
            return false;
        }
    }
}
