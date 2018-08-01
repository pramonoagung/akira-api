<?php 
namespace App\GraphQL\Query\Manajemen;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Thunderlabid\Manajemen\Models\KetersediaanTerapis;
/**
 * User Query
 */
class KetersediaanTerapisQuery extends Query
{
	
	protected $attributes = [
		'name' => 'KetersediaanTerapisQuery'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('KetersediaanTerapisType'));
	}
	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::int()],
			'posisi' => ['name' => 'posisi', 'type' => Type::string()],
			'tanggal_mulai' => ['name' => 'tanggal_mulai', 'type' => Type::string()],
			'tanggal_berakhir' => ['name' => 'tanggal_berakhir', 'type' => Type::string()]
		];
	}
	public function resolve($root, $args)
	{
		if (isset($args['id'])) {
			return KetersediaanTerapis::where('id', $args['id'])->get();
		}elseif(isset($args['posisi'])){
			return KetersediaanTerapis::where('posisi', $args['posisi'])->get();
		}elseif(isset($args['tanggal_mulai'])){
			return KetersediaanTerapis::where('tanggal_mulai', $args['tanggal_mulai'])->get();
		}elseif(isset($args['tanggal_berakhir'])){
			return KetersediaanTerapis::where('tanggal_berakhir', $args['tanggal_berakhir'])->get();
		}else{
			return KetersediaanTerapis::all();
		}
	}

}