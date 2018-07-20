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
                'type' => Type::int(),
            ],
            'durasi' => [
                'type' => Type::int(),
            ],
            'produk' => [
                'type' => Type::string(),
            ],
            'terapis' => [
                'type' => Type::string(),
            ],
            'header_reservasi_id' => [
                'type' => Type::int(),
            ],
            'header_reservasi' => [
                'args' => [
                    'id' => [
                        'type'        => Type::int(),
                        'description' => 'id of header',
                    ],
                ],
                'type' => Type::listOf(GraphQL::type('ReservasiHT')),
                'description' => 'header description',
                'resolve' => function ($root, $args) {
                    if (isset($args['header_reservasi_id'])) {
                        return  $root->header_reservasi->findOrFail('id', $args['header_reservasi_id']);
                    }
                    return $root->header_reservasi;
                }
            ],
        ];
    }
}
