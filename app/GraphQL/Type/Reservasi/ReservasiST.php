<?php

namespace App\GraphQL\Type\Reservasi;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class ReservasiST extends BaseType
{
    protected $attributes = [
        'name' => 'ReservasiST',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'tanggal' => [
                'type' => Type::nonNull(Type::string()),
            ],
            'status' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'progress' => [
                'type' => Type::int(),
            ],
            'header_reservasi_id' => [
                'type' => Type::nonNull(Type::int()),
            ],
        ];
    }
}
