<?php 
namespace App\GraphQL\Type\Manajemen;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
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
			]
		];
	}
}