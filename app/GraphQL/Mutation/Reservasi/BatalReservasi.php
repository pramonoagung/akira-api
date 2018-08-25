<?php

namespace App\GraphQL\Mutation\Reservasi;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Thunderlabid\Reservasi\Models\ReservasiStatus;
use Thunderlabid\Reservasi\Models\ReservasiHeader;
use GraphQL;
use DB;

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
            'ref_id' => ['name' => 'ref_id', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $reservasi = ReservasiHeader::where('kode', $args['ref_id'])->first();
        if($reservasi){
            try{
                DB::beginTransaction();
                $status = ReservasiStatus::where('header_reservasi_id', $reservasi->id)->first();
                $status->tanggal = date('Y-m-d h:i:s', time());
                $status->status = "batal";
                $status->progress = "batal";
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
