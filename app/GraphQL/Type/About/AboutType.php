<?php 
namespace App\GraphQL\Type\About;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL;	
/**
 * User Type
 */
class AboutType extends GraphQLType
{
	
	protected $attributes = [
		'name' => 'AboutType',
		'description' => 'AboutType'
	];
	public function fields()
	{
		return [
			'id' => [
				'type' => Type::nonNull(Type::int()),
				'description' => 'ID Header Transaksi'
			],
			'nama' => [
				'type' => Type::string(),
				'description' => 'nama'
			],
			'alamat' => [
				'type' => Type::string(),
				'description' => 'alamat'
			],
			'kontak' => [
				'type' => Type::string(),
				'description' => 'kontak'
			],
			
		];
	}
}