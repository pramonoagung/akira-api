<?php 
namespace App\GraphQL\Type\Manajemen;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL;	
/**
 * User Type
 */
class KaryawanType extends GraphQLType
{
	
	protected $attributes = [
		'name' => 'KaryawanType',
		'description' => 'KaryawanType'
	];
	public function fields()
	{
		return [
			'id' => [
				'type' => Type::nonNull(Type::int()),
				'description' => 'ID Header Transaksi'
			],
			'uuid' => [
				'type' => Type::string(),
				'description' => 'uuid'
			],
			'nip' => [
				'type' => Type::string(),
				'description' => 'nip'
			],
			'nama' => [
				'type' => Type::string(),
				'description' => 'nama'
			],
			'rating' => [
				'type' => Type::string(),
				'description' => 'rating'
			],
			'penempatan' => [
				'args' => [
					'id' =>[
						'type' => Type::int(),
						'description' => 'Header id',
					],
				],

				'type' => Type::listOf(GraphQL::type('PenempatanType')),
				'description' => 'foreign header transaksi id',

				'resolve' =>function($root,$args){
					if(isset($args['id'])){
						return $root->penempatan->where('penempatan',$args['id']);
					}
					return $root->penempatan;
				}
			]
		];
	}
}