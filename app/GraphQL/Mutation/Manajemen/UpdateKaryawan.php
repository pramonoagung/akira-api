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
		return GraphQL::type('KaryawanType');
	}
	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::int()],
			'nama' => ['name' => 'nama', 'type' => Type::string()],
			'jenis_kelamin' => ['name' => 'jenis_kelamin', 'type' => Type::string()]
		];
	}
	public function resolve($root, $args)
	{
		$data = Karyawan::find($args['id']);
		isset($args['nama'])?$data->nama = $args['nama']:'';
		isset($args['jenis_kelamin'])?$data->jenis_kelamin = $args['jenis_kelamin']:'';

        $data->save();

		return $data;
	}
}