<?php

namespace App\GraphQL\Mutation\Reservasi;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Reservasi\Models\ReservasiHeader as RH;

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
            'kode' => ['name' => 'kode', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $header = new RH();
        $header->fill($args);
        $header->save();
        return $header;
    }
}
