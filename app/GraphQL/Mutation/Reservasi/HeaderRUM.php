<?php

namespace App\GraphQL\Mutation\Reservasi;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Reservasi\Models\ReservasiHeader;

class HeaderRUM extends Mutation
{
    protected $attributes = [
        'name' => 'HeaderRUM',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('ReservasiHT');
    }

    public function args()
    {
        return [
           'id' => ['name' => 'id', 'type' => Type::int()],
           'tanggal_reservasi' => ['name' => 'tanggal_reservasi', 'type' => Type::string()],
           'tamu' => ['name' => 'tamu', 'type' => Type::string()],
           'kode' => ['name' => 'kode', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $header = ReservasiHeader::findOrFail($args['id']);
        $args['tanggal_reservasi']? $header->tanggal_reservasi = $args['tanggal_reservasi']:'';
        $args['tamu']? $header->tamu = $args['tamu']:'';
        $args['kode']? $header->kode = $args['kode']:'';
        $header->save();

        return $header;
    }
}
