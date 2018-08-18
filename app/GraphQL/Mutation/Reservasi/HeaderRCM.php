<?php

namespace App\GraphQL\Mutation\Reservasi;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\DB;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Reservasi\Models\ReservasiHeader as RH;
use Thunderlabid\Reservasi\Models\ReservasiDetail as RD;
use Thunderlabid\Reservasi\Models\ReservasiStatus as RS;
use Thunderlabid\Otorisasi\Models\User;

class HeaderRCM extends Mutation
{
    protected $attributes = [
        'name' => 'HeaderRCM',
        'description' => 'A mutation'
    ];
    
    public function type()
    {
        return GraphQL::type('ReservasiHT');
    }
    
    public function args()
    {
        return [
            'tanggal_reservasi' => ['name' => 'tanggal_reservasi', 'type' => Type::string()],
            'username' => ['name' => 'username', 'type' => Type::string()],
            'produk_id' => ['name' => 'produk_id', 'type' => Type::int()],
            'karyawan_id' => ['name' => 'karyawan_id', 'type' => Type::int()]
        ];
    }
    
    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        
        try{
            DB::beginTransaction();
            $header = new RH;
            $detail = new RD;
            $status = new RS;
            $header->tanggal_reservasi = $args['tanggal_reservasi'];
            $header->tamu = $args['username'];
            $header->kode = $this->getKode();
            $header->save();

            $inc = 100000 + $header->id;

            $header->kode = date('ymd')."RH".$inc;
            $header->save();
            
            $detail->produk_id = $args['produk_id'];
            $detail->karyawan_id = $args['karyawan_id'];
            $detail->header_reservasi_id = $header->id;
            $detail->save();
            
            $status->tanggal = date('m/d/Y h:i:s a', time());
            $status->status = 'pending';
            $status->header_reservasi_id = $header->id;
            $status->save();
           DB::Commit();
            return $header;
        }catch(\Exception $e){
            dd(401);
            DB::Rollback();
        }        
    }
    
    private function getKode()
    {
        return str_random(30);
    }
}
