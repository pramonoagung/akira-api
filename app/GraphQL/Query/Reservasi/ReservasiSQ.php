<?php

namespace App\GraphQL\Query\Reservasi;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Reservasi\Models\ReservasiStatus as RS;

class ReservasiSQ extends Query
{
    protected $attributes = [
        'name' => 'ReservasiSQ',
        'description' => 'A query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('ReservasiST'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'header_reservasi_id' => ['name' => 'header_reservasi_id', 'type' => Type::int()],
            'tanggal' => ['name' => 'tanggal', 'type' => Type::string()],
            'status' => ['name' => 'status', 'type' => Type::string()],
            'progress' => ['name' => 'progress', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        if(isset($args['id'])) {
            return RS::where('id' ,$args['id'])->get();
        }elseif(isset($args['header_reservasi_id'])) {
            return RS::where('header_reservasi_id' ,$args['header_reservasi_id'])->get();
        }elseif(isset($args['tanggal'])) {
            return RS::where('tanggal' ,$args['tanggal'])->get();
        }elseif(isset($args['status'])) {
            return RS::where('status' ,$args['status'])->orderBy('created_at', 'desc')->get();
        }elseif(isset($args['progress'])) {
            return RS::where('progress' ,$args['progress'])->get();
        }else {
            return RS::all();
        }
    }
}
