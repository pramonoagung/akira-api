<?php 
namespace App\GraphQL\Mutation\Manajemen;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Manajemen\Models\Workshift;
/**
 * User Query
 */
class DeleteWorkshift extends Mutation
{
	
	protected $attributes = [
		'name' => 'DeleteWorkshift'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('WorkshiftType'));
	}
	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::int()]
		];
	}
	public function resolve($root, $args)
	{
		$data = Workshift::find($args['id']);

		$data->delete();

		return Workshift::all();
	}
}