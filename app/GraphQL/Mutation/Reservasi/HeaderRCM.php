<?php

namespace App\GraphQL\Mutation\Reservasi;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Illuminate\Support\Facades\DB;
use Thunderlabid\Reservasi\Models\ReservasiHeader as RH;
use Thunderlabid\Reservasi\Models\ReservasiDetail as RD;
use Thunderlabid\Reservasi\Models\ReservasiStatus as RS;

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
            'tamu' => ['name' => 'tamu', 'type' => Type::string()],
            'durasi' => ['name' => 'durasi', 'type' => Type::string()],
            'produk' => ['name' => 'produk', 'type' => Type::string()],
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
            $header->tamu = $args['tamu'];
            $header->kode = $this->getKode();
            $header->save();
            
            $detail->durasi = $args['durasi'];
            $detail->produk = $args['produk'];
            $detail->karyawan_id = $args['karyawan_id'];
            $detail->header_reservasi_id = $header->id;
            $detail->save();
            
            $status->tanggal = date('m/d/Y h:i:s a', time());
            $status->status = 'diterima';
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
