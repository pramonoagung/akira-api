<?php

namespace App\GraphQL\Type\Reservasi;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class ReservasiHT extends BaseType
{
    protected $attributes = [
        'name' => 'ReservasiHT',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::int(),
            ],
            'tanggal_reservasi' => [
                'type' => Type::string(),
            ],
            'tamu' => [
                'type' => Type::string(),
            ],
            'kode' => [
                'type' => Type::string(),
            ],
            'detail_reservasi' => [
                'args' => [
                    'id' => [
                        'type'        => Type::int(),
                        'description' => 'id of detail',
                    ],
                ],
                'type' => Type::listOf(GraphQL::type('ReservasiDT')),
                'description' => 'detail description',
                'resolve' => function ($root, $args) {
                    if (isset($args['id'])) {
                        return  $root->detail_reservasi->where('header_reservasi_id', $args['id']);
                    }
                    return $root->detail_reservasi;
                }
            ],
            'status_reservasi' => [
                'args' => [
                    'id' => [
                        'type'        => Type::int(),
                        'description' => 'id of status',
                    ],
                ],
                'type' => Type::listOf(GraphQL::type('ReservasiST')),
                'description' => 'status description',
                'resolve' => function ($root, $args) {
                    if (isset($args['id'])) {
                        return  $root->status_reservasi->where('header_reservasi_id', $args['id']);
                    }
                    return $root->status_reservasi;
                }
            ],
        ];
    }
}
