<?php 
namespace App\GraphQL\Mutation\Manajemen;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Manajemen\Models\Karyawan;
/**
 * User Query
 */
class DeleteKaryawan extends Mutation
{
	
	protected $attributes = [
		'name' => 'DeleteKaryawan'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('KaryawanType'));
	}
	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::int()]
		];
	}
	public function resolve($root, $args)
	{
		$data = Karyawan::find($args['id']);

		$data->delete();

		return Karyawan::all();
	}
}