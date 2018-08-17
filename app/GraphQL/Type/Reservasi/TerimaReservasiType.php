<?php

namespace App\GraphQL\Type\Reservasi;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class TerimaReservasiType extends BaseType
{
    protected $attributes = [
        'name' => 'TerimaReservasiType',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'status' => [
                'type' => Type::string(),
            ],
            'progress' => [
                'type' => Type::string(),
            ]

        ];
    }
}
