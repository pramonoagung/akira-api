<?php 
namespace App\GraphQL\Mutation\Manajemen;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Manajemen\Models\Penempatan;
/**
 * User Query
 */
class DeletePenempatan extends Mutation
{
	
	protected $attributes = [
		'name' => 'DeletePenempatan'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('PenempatanType'));
	}
	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::int()]
		];
	}
	public function resolve($root, $args)
	{
		$data = Penempatan::find($args['id']);

		$data->delete();

		return Penempatan::all();
	}
}