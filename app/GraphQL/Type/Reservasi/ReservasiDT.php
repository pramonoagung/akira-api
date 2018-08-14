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
                'type' => Type::string(),
            ],
            'produk' => [
                'type' => Type::string(),
            ],
            'karyawan_id' => [
                'type' => Type::int(),
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
                        return  $root->header_reservasi->where('id', $args['header_reservasi_id'])->get();
                    }
                    return $root->header_reservasi;
                }
            ],
        ];
    }
}
