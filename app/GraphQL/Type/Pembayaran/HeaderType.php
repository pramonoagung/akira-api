<?php 
namespace App\GraphQL\Type\Pembayaran;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL;
/**
 * User Type
 */
class HeaderType extends GraphQLType
{
	
	protected $attributes = [
		'name' => 'HeaderType',
		'description' => 'Header Transaksi'
	];
	public function fields()
	{
		return [
			'id' => [
				'type' => Type::nonNull(Type::int()),
				'description' => 'ID Header Transaksi'
			],
			'nomor' => [
				'type' => Type::string(),
				'description' => 'Nomor Header Transaksi'
			],
			'tanggal' => [
				'type' => Type::string(),
				'description' => 'Tanggal Header Transaksi'
			],
			'id_pembayaran' => [
				'args' => [
					'id' =>[
						'type' => Type::int(),
						'description' => 'Header id',
					],
				],

				'type' => Type::listOf(GraphQL::type('PembayaranType')),
				'description' => 'foreign header transaksi id',

				'resolve' =>function($root,$args){
					if(isset($args['id'])){
						return $root->pembayaran->where('id_pembayaran',$args['id']);
					}
					return $root->pembayaran;
				}
			],
			'id_detail' => [
				'args' => [
					'id' =>[
						'type' => Type::int(),
						'description' => 'Header id',
					],
				],

				'type' => Type::listOf(GraphQL::type('DetailType')),
				'description' => 'foreign header transaksi id',

				'resolve' =>function($root,$args){
					if(isset($args['id'])){
						return $root->detail->where('id_detail',$args['id']);
					}
					return $root->detail;
				}
			]
		];
	}
}