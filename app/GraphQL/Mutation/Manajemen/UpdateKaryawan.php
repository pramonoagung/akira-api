<?php 
namespace App\GraphQL\Mutation\Manajemen;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Manajemen\Models\Karyawan;
/**
 * User Query
 */
class UpdateKaryawan extends Mutation
{
	
	protected $attributes = [
		'name' => 'UpdateKaryawan'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('KaryawanType'));
	}
	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::int()],
			'nama' => ['name' => 'nama', 'type' => Type::string()]
		];
	}
	public function resolve($root, $args)
	{
		$data = Karyawan::find($args['id']);
		$data->nama = $args['nama'];

        $data->save();

		return Karyawan::all();
	}
}