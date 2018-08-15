<?php

namespace App\GraphQL\Mutation\Reservasi;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Reservasi\Models\ReservasiDetail as RD;
use Illuminate\Support\Facades\DB;

class DetailRCM extends Mutation
{
    protected $attributes = [
        'name' => 'DetailRCM',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('ReservasiDT');
    }

    public function args()
    {
        return [
            'header_reservasi_id' => ['name' => 'header_reservasi_id', 'type' => Type::int()],
            'durasi' => ['name' => 'durasi', 'type' => Type::string()],
            'produk' => ['name' => 'produk', 'type' => Type::string()],
            'karyawan_id' => ['name' => 'karyawan_id', 'type' => Type::int()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        try{
            DB::beginTransaction();
            $detail = new RD;
            $detail->header_reservasi_id = $args['header_reservasi_id'];
            $detail->durasi = $args['durasi'];
            $detail->produk = $args['produk'];
            $detail->karyawan_id = $args['karyawan_id'];
            $detail->save();
           DB::Commit();
            return $detail;
        }catch(\Exception $e){
            dd(401);
            DB::Rollback();
        }  
    }
}
