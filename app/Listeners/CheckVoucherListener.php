<?php

namespace App\Listeners;

use App\Events\CheckVoucherEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Thunderlabid\Pembayaran\Models\Pembayaran;
use Thunderlabid\Voucher\Models\Voucher;

class CheckVoucherListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    public function __construct(Pembayaran $referensi)
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  CheckVoucherEvent  $event
     * @return void
     */
    public function handle(CheckVoucherEvent $event)
    {
        $validate = $event->referensi;
        $voucher = Voucher::where('kode',$validate->referensi)->first();

        if($voucher){
           if($voucher->status == 1){
            $voucher->status = 0;
            $voucher->save();
            return true;
           }else
           {
            dd("voucher terpakai");
           }

        }else
        {
            dd("Voucher tidak ada");
            return false;
        }
        //dd('listener');

    }

    
}
