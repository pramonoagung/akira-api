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
                'type' => Type::string(),
            ],
            'status' => [
                'type' => Type::string(),
            ],
            'progress' => [
                'type' => Type::string(),
            ],
            'header_reservasi_id' => [
                'args' => [
                    'id' =>[
                        'type' => Type::int(),
                        'description' => 'Header id',
                    ],
                ],

                'type' => GraphQL::type('ReservasiHT'),
                'description' => 'foreign header transaksi id',

                'resolve' =>function($root,$args){
                    if(isset($args['id'])){
                        return $root->header_reservasi->where('header_reservasi_id',$args['id']);
                    }
                    return $root->header_reservasi;
                }
            ],

        ];
    }
}
