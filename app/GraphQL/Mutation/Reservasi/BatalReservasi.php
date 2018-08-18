<?php

namespace App\GraphQL\Mutation\Reservasi;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Thunderlabid\Reservasi\Models\ReservasiDetail as RD;
use GraphQL;

class BatalReservasi extends Mutation
{
    protected $attributes = [
        'name' => 'BatalReservasi',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('ReservasiHT');
    }

    public function args()
    {
        return [
            'ref_id' => ['name' => 'ref_id', 'type' => Type::int()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $reservasi = ReservasiHeader::where('kode', $args['ref_id'])->first();
        if($reservasi){
            try{
                
                // dd($produk->nama);
                DB::beginTransaction();
                $status = ReservasiStatus::where('header_reservasi_id', $reservasi->id)->first();
                $status->progress = "checkin";
                $status->save();
                
                DB::Commit();
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
