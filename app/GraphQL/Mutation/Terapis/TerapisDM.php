<?php

namespace App\GraphQL\Mutation\Terapis;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Terapis\Models\Terapis;
use Illuminate\Support\Facades\DB;

class TerapisDM extends Mutation
{
    protected $attributes = [
        'name' => 'TerapisDM',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('TerapisT');
    }

    public function args()
    {
        return [
            'id'    => ['name'=> 'id', 'type' => Type::int(), 'rule' => ['required']]  
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        try{
            DB::BeginTransaction();
            $terapis = Terapis::findOrFail($args['id']);
            $terapis->delete();
            DB::Commit(); 
            return $terapis; 
        }catch(Exception $e){
            DB::Rollback();
        }
    }
}
