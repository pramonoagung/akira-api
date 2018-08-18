<?php

namespace App\GraphQL\Query\Terapis;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Terapis\Models\Rating as R;

class Rating extends Query
{
    protected $attributes = [
        'name' => 'Rating',
        'description' => 'A query'
    ];
    
    public function type()
    {
        return Type::listOf(Graphql::type('Rating'));
    }
    
    public function args()
    {
        return [
            'id' => ['name'=> 'karyawan_id', 'type' => Type::int()],
            'karyawan_id' => ['name'=> 'karyawan_id', 'type' => Type::int()],
            'user_id' => ['name'=> 'user_id', 'type' => Type::int()],
            'rating' => ['name'=> 'rating', 'type' => Type::int()],
        ];
    }
    
    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        if(isset($args['id'])){
            $rating = R::find($args['id']);
        }elseif (isset($args['karyawan_id'])) {
            $rating = R::where($args['karyawan_id'])->get();         
        }elseif (isset($args['user_id'])) {  
            $rating = R::where($args['user_id'])->get(); 
        }elseif (isset($args['rating'])) {            
            $rating = R::where($args['rating'])->get(); 
        }elseif (isset($args['komentar'])) {
            $rating = R::where($args['komentar'])->get(); 
        }else{
            $rating = R::all();
        }
        return $rating;
    }
}
