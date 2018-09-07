<?php

namespace App\GraphQL\Mutation\Terapis;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\DB;
use GraphQL;
use Thunderlabid\Terapis\Models\Rating;
use Thunderlabid\Reservasi\Models\ReservasiStatus;
use Thunderlabid\Reservasi\Models\ReservasiHeader;

class CreateRating extends Mutation
{
    protected $attributes = [
        'name' => 'CreateRating',
        'description' => 'A mutation'
    ];
    
    public function type()
    {
        return GraphQL::type('Rating');
    }
    
    public function args()
    {
        return [
            'karyawan_id' => ['name'=> 'karyawan_id', 'type' => Type::nonNull(Type::int())],
            'header_reservasi_id' => ['name'=> 'header_reservasi_id', 'type' => Type::nonNull(Type::int())],
            'user_id' => ['name'=> 'user_id', 'type' => Type::nonNull(Type::int())],
            'rating' => ['name'=> 'rating', 'type' => Type::nonNull(Type::int())],
            'komentar' => ['name'=> 'komentar', 'type' => Type::string()],
            'status' => ['name'=> 'komentar', 'type' => Type::string()]
        ];
    }
    
    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $args['status'] = true;
        $rating = new Rating;
        $rating->fill($args);
        $rating->save();
        $this->setDone($args['header_reservasi_id']);
        return $rating;
    }
    
    private function setDone($id){
        $reservasi = ReservasiHeader::find($id);
        if($reservasi){
            try{
                DB::beginTransaction();
                $status = ReservasiStatus::where('header_reservasi_id', $reservasi->id)->first();
                $status->status = "rated";
                $status->tanggal = \Carbon\Carbon::now()->toDateTimeString();
                $status->save();
                
                DB::Commit();
                return $status;
            }catch(\Exception $e){
                DB::Rollback();
            }
        }
    }
}
