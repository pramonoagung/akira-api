<?php 
namespace App\GraphQL\Type\Manajemen;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL;
/**
 * User Type
 */
class PenempatanType extends GraphQLType
{
	
	protected $attributes = [
		'name' => 'PenempatanType',
		'description' => 'PenempatanType'
	];
	public function fields()
	{
		return [
			'id' => [
				'type' => Type::nonNull(Type::int()),
				'description' => 'ID Header Transaksi'
			],
			'posisi' => [
				'type' => Type::string(),
				'description' => 'posisi'
			],
			'tanggal_mulai' => [
				'type' => Type::string(),
				'description' => 'tanggal_mulai'
			],
			'tanggal_berakhir' => [
				'type' => Type::string(),
				'description' => 'tanggal_berakhir'
			],
			'workshift' => [
				'args' => [
					'id' =>[
						'type' => Type::int(),
						'description' => 'Header id',
					],
				],

				'type' => Type::listOf(GraphQL::type('WorkshiftType')),
				'description' => 'foreign header transaksi id',

				'resolve' =>function($root,$args){
					if(isset($args['id'])){
						return $root->workshift->where('workshift',$args['id']);
					}
					return $root->workshift;
				}
			],
			'ketersediaan' => [
				'args' => [
					'id' =>[
						'type' => Type::int(),
						'description' => 'Header id',
					],
				],

				'type' => Type::listOf(GraphQL::type('KetersediaanTerapisType')),
				'description' => 'foreign header transaksi id',

				'resolve' =>function($root,$args){
					if(isset($args['id'])){
						return $root->ketersediaan->where('ketersediaan',$args['id']);
					}
					return $root->ketersediaan;
				}
			]
		];
	}
}