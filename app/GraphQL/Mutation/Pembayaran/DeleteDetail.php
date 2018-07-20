<?php 
namespace App\GraphQL\Mutation\Pembayaran;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Pembayaran\Models\DetailTransaksi;
/**
 * User Query
 */
class DeleteDetail extends Mutation
{
	
	protected $attributes = [
		'name' => 'DeleteDetail'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('DetailType'));
	}
	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::int()]
		];
	}
	public function resolve($root, $args)
	{
		$data = DetailTransaksi::find($args['id']);

		$data->delete();

		return DetailTransaksi::all();
	}
}