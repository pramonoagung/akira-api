<?php 
namespace App\GraphQL\Type\Voucher;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
Use App\GraphQL\Type\User\User;
use GraphQL;
/**
 * User Type
 */
class CheckVoucherType extends GraphQLType
{
	
	protected $attributes = [
		'name' => 'CheckVoucherType',
		'description' => 'Voucher'
	];
	public function fields()
	{
		return [
			
			'jumlah' => [
				'type' => Type::int(),
				'description' => 'jumlah Voucher'
			],
			
		];
	}
}