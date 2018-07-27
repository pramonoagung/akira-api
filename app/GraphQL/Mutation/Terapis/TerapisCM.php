<?php

namespace App\GraphQL\Mutation\Terapis;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Terapis\Models\Terapis;
use Illuminate\Support\Facades\DB;

class TerapisCM extends Mutation
{
    protected $attributes = [
        'name' => 'TerapisCM',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('TerapisT'); 
    }

    public function args()
    {
        return [
            'nama' => ['name'=> 'nama', 'type' => Type::string(), 'rules' => ['required']],
            'rating' => ['name' => 'rating', 'type' => Type::float()],
            'status' => ['name' => 'status', 'type' => Type::boolean()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        
        $args['status'] = true;
        $args['rating'] = 0;
        try{
            DB::BeginTransaction();
            $terapis = new Terapis;
            $terapis->fill($args);
            $terapis->save();
            DB::Commit(); 
            return $terapis; 
        }catch(Exception $e){
            DB::Rollback();
        }
    }
}
