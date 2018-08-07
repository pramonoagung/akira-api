<?php 
namespace App\GraphQL\Mutation\Voucher;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Voucher\Models\Voucher;
/**
 * User Query
 */
class UpdateOwner extends Mutation
{
	
	protected $attributes = [
		'name' => 'UpdateOwner'
	];
	public function type()
	{
		return GraphQL::type('VoucherType');
	}
	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::int()],
			'owner_id' => ['name' => 'owner_id', 'type' => Type::int()],
		];
	}
	public function resolve($root, $args)
	{
		$data = Voucher::find($args['id']);

		$data->owner_id = $args['owner_id'];
		
        $data->save();

		return $data;
	}
}