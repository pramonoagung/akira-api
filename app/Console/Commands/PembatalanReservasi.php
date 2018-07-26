<?php
namespace App\Console\Commands;
 
use Illuminate\Console\Command;
use Thunderlabid\Reservasi\Models\ReservasiHeader as RH;
 
class PembatalanReservasi extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'reservasi:pembatalan';
 
  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Pembatalan reservasi';
 
  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
  }
 
  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function handle()
  {
    date_default_timezone_set('Asia/Jakarta');
    $DATE_NOW = date('Y-m-d h:i:s', time());
    $reservasi = RH::select('tanggal_reservasi')->get();
    foreach($reservasi as $target){
        if((strtotime($target['tanggal_reservasi']) - strtotime($DATE_NOW)) == 600){
            $target->delete();
        }
    }
    
  }
}