<?php 
namespace App\GraphQL\Query\Manajemen;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Thunderlabid\Manajemen\Models\Penempatan;
/**
 * User Query
 */
class PenempatanQuery extends Query
{
	
	protected $attributes = [
		'name' => 'PenempatanQuery'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('PenempatanType'));
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
			return Penempatan::where('id', $args['id'])->get();
		}elseif(isset($args['posisi'])){
			return Penempatan::where('posisi', $args['posisi'])->get();
		}elseif(isset($args['tanggal_mulai'])){
			return Penempatan::where('tanggal_mulai', $args['tanggal_mulai'])->get();
		}elseif(isset($args['tanggal_berakhir'])){
			return Penempatan::where('tanggal_berakhir', $args['tanggal_berakhir'])->get();
		}else{
			return Penempatan::all();
		}
	}

}