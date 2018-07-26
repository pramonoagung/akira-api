<?php

namespace App\GraphQL\Query\Terapis;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Terapis\Models\Terapis;
use App\Events\CekTerapisEvent;

class CekTerapisQ extends Query
{
    protected $attributes = [
        'name' => 'TerapisQ',
        'description' => 'A query'
    ];

    public function type()
    {
        return GraphQL::type('CekTerapisT');
    }

    public function args()
    {
        return [
            'id' => [
                'type' => Type::int(),
            ],
            'nama' => [
                'type' => Type::string(),
            ],
            'status' => [
                'type' => Type::string(),
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $cekTerapis = (boolean)event(new CekTerapisEvent($args['id']));

        if($cekTerapis){
            return ['id' => '', 'status' => 'Tersedia'];
        }else{
            return ['id' => '', 'status' => 'Tidak Tersedia'];
        }

    }
}