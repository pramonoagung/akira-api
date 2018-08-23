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
            $array = [];
            $nominal = $voucher->jumlah;
            $kode = $voucher->kode;
            $array[0] = $nominal;
            $array[1] = $kode;
            // dd($nominal);
            $voucher->status = 0;
            $voucher->save();
            return $array;
           }else
           {
            $array = [];
            $nominal = 0;
            $kode = "voucher hangus";

            $array[0] = $nominal;
            $array[1] = $kode;
            // dd('Voucher Hangus');
            return $array;
           }

        }else
        {
            // dd('Voucher Tidak ada');
            $array = [];
            $nominal = 0;
            $kode = "voucher tidak valid";

            $array[0] = $nominal;
            $array[1] = $kode;
            // dd('Voucher Hangus');
            return $array;
        }
        //dd('listener');

    }

    
}
