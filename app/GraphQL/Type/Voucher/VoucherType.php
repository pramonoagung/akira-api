<?php 
namespace App\GraphQL\Type\Voucher;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL;
/**
 * User Type
 */
class VoucherType extends GraphQLType
{
	
	protected $attributes = [
		'name' => 'VoucherType',
		'description' => 'Voucher'
	];
	public function fields()
	{
		return [
			'id' => [
				'type' => Type::nonNull(Type::int()),
				'description' => 'ID Voucher'
			],
			'kode' => [
				'type' => Type::string(),
				'description' => 'Kode Voucher'
			],
			'jenis' => [
				'type' => Type::string(),
				'description' => 'Jenis Voucher'
			],
			'syarat' => [
				'type' => Type::string(),
				'description' => 'syarat Voucher'
			],
			'tanggal_kadaluarsa' => [
				'type' => Type::string(),
				'description' => 'tanggal_kadaluarsa Voucher'
			],
			'id_kepemilikan' => [
				'args' => [
					'id' =>[
						'type' => Type::int(),
						'description' => 'foreign Voucher id di table kepemilikan',
					],
				],

				'type' => Type::listOf(GraphQL::type('KepemilikanType')),
				'description' => 'foreign Voucher id di table kepemilikan',

				'resolve' =>function($root,$args){
					if(isset($args['id'])){
						return $root->kepemilikan->where('id_kepemilikan',$args['id']);
					}
					return $root->kepemilikan;
				}
			]
		];
	}
}