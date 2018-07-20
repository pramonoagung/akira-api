<?php 
namespace App\GraphQL\Type\Voucher;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
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
			]
		];
	}
}