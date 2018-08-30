<?php

namespace App\GraphQL\Type\Notifikasi;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class Notifikasi extends BaseType
{
    protected $attributes = [
        'name' => 'Notifikasi',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
            ],
        ];
    }
}
