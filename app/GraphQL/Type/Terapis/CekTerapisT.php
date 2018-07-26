<?php

namespace App\GraphQL\Type\Terapis;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class CekTerapisT extends BaseType
{
    protected $attributes = [
        'name' => 'CekTerapisT',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [
            'status' => [
                'type' => Type::string(),
            ]
        ];
    }
}
