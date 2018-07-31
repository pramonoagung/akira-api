<?php 
namespace App\GraphQL\Type\Voucher;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL;
/**
 * User Type
 */
class KepemilikanType extends GraphQLType
{
	
	protected $attributes = [
		'name' => 'KepemilikanType',
		'description' => 'Detail Transaksi'
	];
	public function fields()
	{
		return [
			'id' => [
				'type' => Type::nonNull(Type::int()),
				'description' => 'ID Header Transaksi'
			],
			'tanggal' => [
				'type' => Type::string(),
				'description' => 'Kode reservasi'
			],
			'pemilik' => [
				'type' => Type::string(),
				'description' => 'Produk'
			],
			'voucher' => [
				'args' => [
					'id' =>[
						'type' => Type::int(),
						'description' => 'foreign Voucher id di table kepemilikan',
					],
				],

				'type' => (GraphQL::type('VoucherType')),
				'description' => 'foreign Voucher id di table kepemilikan',

				'resolve' =>function($root,$args){
					if(isset($args['id'])){
						return $root->voucher->where('voucher',$args['id']);
					}
					return $root->voucher;
				}
			]
		];
	}
}