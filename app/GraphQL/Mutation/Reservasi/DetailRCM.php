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
            'produk_id' => ['name' => 'produk_id', 'type' => Type::int()],
            'karyawan_id' => ['name' => 'karyawan_id', 'type' => Type::int()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        try{
            DB::beginTransaction();
            $detail = new RD;
            $detail->header_reservasi_id = $args['header_reservasi_id'];
            $detail->produk_id = $args['produk_id'];
            $detail->karyawan_id = $args['karyawan_id'];
            $detail->save();
           DB::Commit();
            return $detail;
        }catch(\Exception $e){
            // dd(401);
            DB::Rollback();
        }  
    }
}
