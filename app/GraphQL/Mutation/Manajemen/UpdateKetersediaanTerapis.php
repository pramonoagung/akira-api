<?php 
namespace App\GraphQL\Mutation\Manajemen;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Manajemen\Models\KetersediaanTerapis;
/**
 * User Query
 */
class UpdateKetersediaanTerapis extends Mutation
{
	
	protected $attributes = [
		'name' => 'UpdateKetersediaanTerapis'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('KetersediaanTerapisType'));
	}
	public function args()
	{
		return [
			'hari' => ['name' => 'hari', 'type' => Type::string()],
			'jam_mulai' => ['name' => 'jam_mulai', 'type' => Type::string()],
			'am_akhir' => ['name' => 'am_akhir', 'type' => Type::string()]
		];
	}
	public function resolve($root, $args)
	{
		$data = KetersediaanTerapis::find($args['id']);

		$data->hari = $args['hari'];
		$data->jam_mulai = $args['jam_mulai'];
		$data->am_akhir = $args['am_akhir'];

        $data->save();

		return KetersediaanTerapis::all();
	}
}