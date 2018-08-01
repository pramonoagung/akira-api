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
			'uuid' => ['name' => 'uuid', 'type' => Type::string()],
			'nip' => ['name' => 'nip', 'type' => Type::string()],
			'nama' => ['name' => 'nama', 'type' => Type::string()]
		];
	}
	public function resolve($root, $args)
	{
		$data = Karyawan::find($args['id']);

		$data->uuid = $args['uuid'];
		$data->nip = $args['nip'];
		$data->nama = $args['nama'];

        $data->save();

		return Karyawan::all();
	}
}