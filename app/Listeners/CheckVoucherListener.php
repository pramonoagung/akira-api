<?php

namespace App\Listeners;

use App\Events\CheckVoucherEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Thunderlabid\Voucher\Models\Voucher;

class CheckVoucherListener
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
    public function handle(CheckVoucherEvent $event)
    {
        // dd('a');
        // $validate = $event->kode;
        $voucher = Voucher::where('kode',$event->kode)->first();
        
        if($voucher){
            // dd('ada');
           $unixTimestamp = strtotime($voucher->tanggal_kadaluarsa);
           if($voucher->status == 1 && time()<$unixTimestamp){
//            dd("valid");
            $nominal = $voucher->jumlah;
            // dd($nominal);
            $voucher->status = 0;
            $voucher->save();
            return $nominal;
           }else
           {
            $nominal = 0;
            // dd('Voucher Hangus');
            return $nominal;
           }

        }else
        {
            // dd('Voucher Tidak ada');
            $nominal = 0;
            return $nominal;
        }
        //dd('listener');

    }

    
}
