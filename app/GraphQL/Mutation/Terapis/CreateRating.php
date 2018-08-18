<?php

namespace App\GraphQL\Mutation\Terapis;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Terapis\Models\Rating;

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
            'user_id' => ['name'=> 'user_id', 'type' => Type::nonNull(Type::int())],
            'rating' => ['name'=> 'rating', 'type' => Type::nonNull(Type::int())],
            'komentar' => ['name'=> 'komentar', 'type' => Type::string()]
        ];
    }
    
    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $rating = new Rating;
        $rating->fill($args);
        $rating->save();

        return $rating;
    }
}
