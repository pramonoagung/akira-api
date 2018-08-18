<?php

namespace App\GraphQL\Type\Terapis;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class Rating extends BaseType
{
    protected $attributes = [
        'name' => 'Rating',
        'description' => 'A type'
    ];
    
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::int(),
            ],
            'karyawan_id' => [
                'type' => Type::int(),
            ],
            'user_id' => [
                'type' => Type::int(),
            ],
            'rating' => [
                'type' => Type::string(),
            ],
            'komentar' => [
                'type' => Type::string(),
            ],
            
        ];
    }
}
