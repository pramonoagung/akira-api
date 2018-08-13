<?php

namespace App\GraphQL\Type\Manajemen;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class CekKetersediaanTerapisType extends BaseType
{
    protected $attributes = [
        'name' => 'CekKetersediaanTerapisType',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [
            'id' => [
				'type' => Type::int()
			],
			'nama' => [
				'name' => 'nama',
				'type' => Type::string()
			]
        ];
	}
}
