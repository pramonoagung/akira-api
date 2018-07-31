<?php

namespace App\GraphQL\Mutation\Reservasi;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Reservasi\Models\ReservasiHeader as RH;
use Thunderlabid\Reservasi\Models\ReservasiDetail as RD;
use Thunderlabid\Reservasi\Models\ReservasiStatus as RS;

class HeaderRCM extends Mutation
{
    protected $attributes = [
        'name' => 'HeaderRCM',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('ReservasiHT');
    }

    public function args()
    {
        return [
            'tanggal_reservasi' => ['name' => 'tanggal_reservasi', 'type' => Type::string()],
            'tamu' => ['name' => 'tamu', 'type' => Type::string()],
            'kode' => ['name' => 'kode', 'type' => Type::string()],
            'durasi' => ['name' => 'durasi', 'type' => Type::string()],
            'produk' => ['name' => 'produk', 'type' => Type::string()],
            'terapis' => ['name' => 'terapis', 'type' => Type::string()],
            'tanggal' => ['name' => 'tanggal', 'type' => Type::string()],
            'status' => ['name' => 'status', 'type' => Type::string()],
            'progress' => ['name' => 'progress', 'type' => Type::string()],
        ];
    }

     public function rules()
    {
        return [
            'id' => ['required'],
            'tanggal_reservasi' => ['required', 'tanggal_reservasi'],
            'tamu' => ['required', 'tamu'],
            'durasi' => ['required', 'durasi'],
            'tanggal' => ['required', 'tanggal'],
            'status' => ['required', 'status']
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        
        //Find the user id [WIP]
        $header = new RH;
        $detail = new RD;
        $status = new RS;
        $header->tanggal_reservasi = $args['tanggal_reservasi'];
        $header->tamu = $args['tamu'];
        $header->kode = $this->geKode();
        $detail->durasi = $args['durasi'];
        $status->tanggal = $args['tanggal'];
        $status->status = $args['status'];
        $header->detail_reservasi()->status_reservasi()->save();
        return $header;

    }

    private function getKode(){
        return str_random(191);
    }
}
