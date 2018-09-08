<?php

namespace App\GraphQL\Mutation\Reservasi;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\DB;
use GraphQL;
use Thunderlabid\Reservasi\Models\ReservasiStatus;
use Thunderlabid\Reservasi\Models\ReservasiHeader;
use App\Events\SendNotification;
use Thunderlabid\Otorisasi\Models\User;

class TolakReservasi extends Mutation
{
    protected $attributes = [
        'name' => 'TolakReservasi',
        'description' => 'A mutation'
    ];
    
    public function type()
    {
        return GraphQL::type('TolakReservasiType');
    }
    
    public function args()
    {
        return [
            'ref_id' => ['name' => 'ref_id', 'type' => Type::string()],
            'header_reservasi_id' => ['name' => 'header_reservasi_id', 'type' => Type::int()],
        ];
    }
    
    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        if(isset( $args['ref_id'])){
            $reservasi = ReservasiHeader::where('kode', $args['ref_id'])->first();
            if($reservasi){
                try{
                    DB::beginTransaction();
                    $status = ReservasiStatus::where('header_reservasi_id', $reservasi->id)->first();
                    $status->status = "ditolak";
                    $status->tanggal = \Carbon\Carbon::now()->toDateTimeString();
                    $status->save();
                    DB::Commit();
                    $user = User::find($reservasi->tamu);
                    $event = event(new SendNotification($user->device_reg_id, "Hmmm, Reservasi kamu ditolak nih :)"));
                    return $status;
                }catch(\Exception $e){
                    DB::Rollback();
                }
            }else
            {
                throw new \Exception("Kode Reservasi not Exists", 999);
            }
        }else{
            $reservasi = ReservasiHeader::find($args['header_reservasi_id']);
            if($reservasi){
                try{
                    DB::beginTransaction();
                    $status = ReservasiStatus::where('header_reservasi_id', $reservasi->id)->first();
                    $status->status = "ditolak";
                    $status->tanggal = \Carbon\Carbon::now()->toDateTimeString();
                    $status->save();                    
                    DB::Commit();
                    $user = User::where('username',$reservasi->tamu)->first();
                    $event = event(new SendNotification($user->device_reg_id, "Hmmm, Reservasi kamu ditolak nih :)"));
                    return $status;
                }catch(\Exception $e){
                    DB::Rollback();
                }
            }else
            {
                throw new \Exception("Kode Reservasi not Exists", 999);
            }
        }
    }
}
