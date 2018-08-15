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
            
            'karyawan_id' => [
                'args' => [
                    'id' => [
                        'type'        => Type::int(),
                        'description' => 'id of header',
                    ],
                ],
                'type' => GraphQL::type('KaryawanType'),
                'description' => 'header description',
                'resolve' => function ($root, $args) {
                    if (isset($args['karyawan_id'])) {
                        return  $root->karyawan->where('id', $args['karyawan_id'])->get();
                    }
                    return $root->karyawan;
                }
            ],
            'produk_id' => [
                'args' => [
                    'id' => [
                        'type'        => Type::int(),
                        'description' => 'id of header',
                    ],
                ],
                'type' => GraphQL::type('ProdukT'),
                'description' => 'header description',
                'resolve' => function ($root, $args) {
                    if (isset($args['produk_id'])) {
                        return  $root->produk->where('id', $args['produk_id'])->get();
                    }
                    return $root->produk;
                }
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
