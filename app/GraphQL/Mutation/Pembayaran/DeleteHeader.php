<?php 
namespace App\GraphQL\Mutation\Pembayaran;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Pembayaran\Models\HeaderTransaksi;
/**
 * User Query
 */
class DeleteHeader extends Mutation
{
	
	protected $attributes = [
		'name' => 'DeleteHeader'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('HeaderType'));
	}
	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::int()]
		];
	}
	public function resolve($root, $args)
	{
		$data = HeaderTransaksi::find($args['id']);

		$data->delete();

		return HeaderTransaksi::all();
	}
}