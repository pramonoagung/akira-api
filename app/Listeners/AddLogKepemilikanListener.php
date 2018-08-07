<?php

namespace App\Listeners;

use App\Events\AddLogKepemilikanEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Thunderlabid\Voucher\Models\Voucher;
use Thunderlabid\Otorisasi\Models\User;
use Thunderlabid\Voucher\Models\Kepemilikan;

class AddLogKepemilikanListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    public function __construct(Voucher $kode)
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  CheckVoucherEvent  $event
     * @return void
     */
    public function handle(AddLogKepemilikanEvent $event)
    {
        // dd($event->username);
        $kepemilikan   = new Kepemilikan;
        $kepemilikan->tanggal     = date('Y-m-d H:i:s', time());
        $kepemilikan->pemilik         = $event->username;
        $kepemilikan->id_voucher     = $event->id;
        $kepemilikan->save();

        return $kepemilikan;
    }

    
}
