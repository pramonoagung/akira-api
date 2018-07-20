<?php 
namespace App\GraphQL\Type\Pembayaran;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL;
/**
 * User Type
 */
class PembayaranType extends GraphQLType
{
	
	protected $attributes = [
		'name' => 'PembayaranType',
		'description' => 'Pembayaran'
	];

	public function fields()
	{
		return [
			'id' => [
				'type' => Type::nonNull(Type::int()),
				'description' => 'ID Pembayaran'
			],
			'jenis' => [
				'type' => Type::string(),
				'description' => 'Jenis Pembayaran(debit / Voucher)'
			],
			'jumlah' => [
				'type' => Type::string(),
				'description' => 'Jumlah Uang Pembayaran'
			],
			'referensi' => [
				'type' => Type::string(),
				'description' => 'Referensi Nomor Debit / Voucher'
			],
			'id_header_transaksi' => [
				'type' => Type::int(),
				'description' => 'id header transaksi'
			],
			'id_detail' => [
				'args' => [
					'id' =>[
						'type' => Type::int(),
						'description' => 'Header id',
					],
				],

				'type' => (GraphQL::type('DetailType')),
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