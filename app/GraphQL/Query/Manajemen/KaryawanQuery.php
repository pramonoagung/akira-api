<?php 
namespace App\GraphQL\Query\Manajemen;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Thunderlabid\Manajemen\Models\Karyawan;
/**
 * User Query
 */
class KaryawanQuery extends Query
{
	
	protected $attributes = [
		'name' => 'KaryawanQuery'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('KaryawanType'));
	}
	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::int()],
			'uuid' => ['name' => 'uuid', 'type' => Type::string()],
			'nip' => ['name' => 'nip', 'type' => Type::string()],
			'nama' => ['name' => 'nama', 'type' => Type::string()],
			'jenis_kelamin' => ['name' => 'jenis_kelamin', 'type' => Type::string()],
			'rating' => ['name' => 'rating', 'type' => Type::string()],
			'skip' => ['name' => 'skip', 'type' => Type::int()],
            'take' => ['name' => 'take', 'type' => Type::int()],
		];
	}
	public function resolve($root, $args)
	{
		if (isset($args['id'])) {
			return Karyawan::where('id', $args['id'])->get();
		}elseif(isset($args['uuid'])){
			return Karyawan::where('uuid', $args['uuid'])->get();
		}elseif(isset($args['nip'])){
			return Karyawan::where('nip', $args['nip'])->get();
		}elseif(isset($args['nama'])){
			return Karyawan::where('nama', $args['nama'])->get();
		}elseif(isset($args['jenis_kelamin'])){
			return Karyawan::where('jenis_kelamin', $args['jenis_kelamin'])->get();
		}else{
			return Karyawan::all();
		}
	}

}