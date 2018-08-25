<?php 
namespace App\GraphQL\Type\Manajemen;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL;
/**
 * User Type
 */
class WorkshiftType extends GraphQLType
{
	
	protected $attributes = [
		'name' => 'WorkshiftType',
		'description' => 'WorkshiftType'
	];
	public function fields()
	{
		return [
			'id' => [
				'type' => Type::nonNull(Type::int()),
				'description' => 'ID Header Transaksi'
			],
			'hari' => [
				'type' => Type::string(),
				'description' => 'hari'
			],
			'jam_mulai' => [
				'type' => Type::string(),
				'description' => 'jam_mulai'
			],
			'jam_akhir' => [
				'type' => Type::string(),
				'description' => 'jam_akhir'
			],
			'flag' => [
				'type' => Type::string(),
				'description' => 'flag'
			],
			'karyawan_id' => [
				'args' => [
					'id' =>[
						'type' => Type::int(),
						'description' => 'Header id',
					],
				],

				'type' => GraphQL::type('PenempatanType'),
				'description' => 'foreign header transaksi id',

				'resolve' =>function($root,$args){
					if(isset($args['id'])){
						return $root->penempatanworkshift->where('karyawan_id',$args['id']);
					}
					return $root->penempatanworkshift;
				}
			]
		];
	}
}