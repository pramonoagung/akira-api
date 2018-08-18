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
            'username' => ['name' => 'username', 'type'=> Type::string()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        if(isset($args['id'])) {
            return ReservasiHeader::where('id' ,$args['id'])->get();
        }elseif(isset($args['username'])){
            return ReservasiHeader::where('tamu' ,$args['username'])->get();
        }elseif(isset($args['kode'])){
            return ReservasiHeader::where('kode' ,$args['kode'])->get();
        }else {
            return ReservasiHeader::all();
        }
    }
}
