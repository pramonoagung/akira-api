<?php 
namespace App\GraphQL\Type\Pembayaran;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
/**
 * User Type
 */
class DetailType extends GraphQLType
{
	
	protected $attributes = [
		'name' => 'DetailType',
		'description' => 'Detail Transaksi'
	];
	public function fields()
	{
		return [
			'id' => [
				'type' => Type::nonNull(Type::int()),
				'description' => 'ID Header Transaksi'
			],
			'ref_id' => [
				'type' => Type::string(),
				'description' => 'Kode reservasi'
			],
			'produk' => [
				'type' => Type::string(),
				'description' => 'Produk'
			],
			'kuantitas' => [
				'type' => Type::string(),
				'description' => 'kuantitas'
			],
			'harga' => [
				'type' => Type::string(),
				'description' => 'Harga satuan'
			],
			'diskon' => [
				'type' => Type::string(),
				'description' => 'Diskon satuan'
			]
		];
	}
}