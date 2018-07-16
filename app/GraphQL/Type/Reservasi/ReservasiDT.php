<?php

namespace App\GraphQL\Type\Reservasi;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class ReservasiDT extends BaseType
{
    protected $attributes = [
        'name' => 'ReservasiDT',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'durasi' => [
                'type' => Type::nonNull(Type::string()),
            ],
            'produk' => [
                'type' => Type::string(),
            ],
            'terapis' => [
                'type' => Type::string(),
            ],
            'header_reservasi_id' => [
                'type' => Type::nonNull(Type::int()),
            ],
        ];
    }
}
