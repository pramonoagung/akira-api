<?php 
namespace App\GraphQL\Mutation\Manajemen;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Manajemen\Models\KetersediaanTerapis;
/**
 * User Query
 */
class DeleteKetersediaanTerapis extends Mutation
{
	
	protected $attributes = [
		'name' => 'DeleteKetersediaanTerapis'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('KetersediaanTerapisType'));
	}
	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::int()]
		];
	}
	public function resolve($root, $args)
	{
		$data = KetersediaanTerapis::find($args['id']);

		$data->delete();

		return KetersediaanTerapis::all();
	}
}