<?php 
namespace App\GraphQL\Mutation\Voucher;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Voucher\Models\Voucher;
/**
 * User Query
 */
class DeleteVoucher extends Mutation
{
	
	protected $attributes = [
		'name' => 'DeleteVoucher'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('VoucherType'));
	}
	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::int()]
		];
	}
	public function resolve($root, $args)
	{
		$data = Voucher::find($args['id']);
		$data->delete();
		return $data;
	}
}