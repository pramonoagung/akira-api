<?php 
namespace App\GraphQL\Mutation\Manajemen;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Manajemen\Models\Workshift;
/**
 * User Query
 */
class DisableWorkshift extends Mutation
{
	
	protected $attributes = [
		'name' => 'DisableWorkshift'
	];

	public function type()
	{
		return (GraphQL::type('WorkshiftType'));
	}

	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::int()],
		];
	}
	
	public function resolve($root, $args)
	{

		$data = Workshift::find($args['id']);

		$data->flag = 0;

        $data->save();

		return $data;
	}
}