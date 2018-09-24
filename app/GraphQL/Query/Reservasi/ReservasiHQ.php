<?php

namespace App\GraphQL\Query\Reservasi;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Reservasi\Models\ReservasiHeader;

class ReservasiHQ extends Query
{
    protected $attributes = [
        'name' => 'ReservasiHQ',
        'description' => 'A query'
    ];
    
    public function type()
    {
        return Type::listOf(GraphQL::type('ReservasiHT'));
    }
    
    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'kode' => ['name' => 'kode', 'type' => Type::string()],
            'tanggal_reservasi' => ['name' => 'tanggal_reservasi', 'type'=> Type::string()],
            'username' => ['name' => 'username', 'type'=> Type::string()],
            'kode' => ['name' => 'kode', 'type'=> Type::string()],
            'status' => ['name' => 'status', 'type' => Type::string()],
            'progress' => ['name' => 'progress', 'type' => Type::string()]
        ];
    }
    
    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        if(isset($args['id'])) {
            return ReservasiHeader::where('id' ,$args['id'])->get();
        }elseif(isset($args['username'])){
            return ReservasiHeader::where('tamu' ,$args['username'])->get();
        }elseif(isset($args['tanggal_reservasi'])){
            return ReservasiHeader::where('tanggal_reservasi' ,$args['tanggal_reservasi'])->get();
        }elseif(isset($args['kode']) && isset($args['status']) && isset($args['progress'])){
            \log::info('masuk');
            return ReservasiHeader::wherehas('status_reservasi', function($q)use($args){
                        $q->where('status', $args['status'])->where('progress', $args['progress']);
                    })->where('kode',$args['kode'])->get();            
        }elseif(isset($args['kode'])){
            return ReservasiHeader::where('kode' ,$args['kode'])->get();
        }else{
            return ReservasiHeader::all();
        }
    }
}
