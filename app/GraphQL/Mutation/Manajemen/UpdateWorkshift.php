<?php 
namespace App\GraphQL\Mutation\Manajemen;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Manajemen\Models\Workshift;
/**
 * User Query
 */
class UpdateWorkshift extends Mutation
{
	
	protected $attributes = [
		'name' => 'UpdateWorkshift'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('WorkshiftType'));
	}
	public function args()
	{
		return [
			'hari' => ['name' => 'hari', 'type' => Type::string()],
			'jam_mulai' => ['name' => 'jam_mulai', 'type' => Type::string()],
			'jam_akhir' => ['name' => 'jam_akhir', 'type' => Type::string()]
		];
	}
	public function resolve($root, $args)
	{
		$data = Workshift::find($args['id']);

		$data->hari = $args['hari'];
		$data->jam_mulai = $args['jam_mulai'];
		$data->jam_akhir = $args['jam_akhir'];

        $data->save();

		return Workshift::all();
	}
}