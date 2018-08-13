<?php

namespace App\Listeners;

use App\Events\CekTerapisEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Thunderlabid\Manajemen\Models\Workshift;
use Thunderlabid\Manajemen\Models\Penempatan;
use Thunderlabid\Manajemen\Models\Karyawan;
use Thunderlabid\Reservasi\Models\ReservasiStatus as RS;
use Thunderlabid\Reservasi\Models\ReservasiHeader as RH;
use Thunderlabid\Reservasi\Models\ReservasiDetail as RD;

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
        //1. cek siapa yang bertugas (KARYAWAN_ID)
        $workshift = Penempatan::wherehas('workshift', function($q)use($event){$q->where('hari', $event->hari);})->get(['karyawan_id']);
        $kid    = array_column($workshift->toarray(), 'karyawan_id');
        
        //2. cek terapis yg ga da jadwal
        $dr     = RD::wherehas('header_reservasi', function($q)use($event){$q->where('tanggal_reservasi', $event->tanggal);})
        ->whereIn('karyawan_id', $kid)->get(['karyawan_id']);
        $tid    = array_column($dr->toarray(), 'karyawan_id');
        
        ///->where('tanggal_reservasi', $event->tanggal)
        //intersection, range
        //3. fetch their names
        $karyawan   = Karyawan::wherenotin('id', $tid)->get();
        //dd($karyawan);
        return $karyawan;
        
    }
}
