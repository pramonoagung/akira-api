<?php 
namespace App\GraphQL\Mutation\Pembayaran;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Pembayaran\Models\Pembayaran;
/**
 * User Query
 */
class DeletePembayaran extends Mutation
{
	
	protected $attributes = [
		'name' => 'DeletePembayaran'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('PembayaranType'));
	}
	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::int()]
		];
	}
	public function resolve($root, $args)
	{
		$data = Pembayaran::find($args['id']);

		$data->delete();

		return Pembayaran::all();
	}
}