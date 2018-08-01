<?php 
namespace App\GraphQL\Query\Manajemen;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Thunderlabid\Manajemen\Models\Workshift;
/**
 * User Query
 */
class WorkshiftQuery extends Query
{
	
	protected $attributes = [
		'name' => 'WorkshiftQuery'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('WorkshiftType'));
	}
	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::int()],
			'hari' => ['name' => 'hari', 'type' => Type::string()],
			'jam_mulai' => ['name' => 'jam_mulai', 'type' => Type::string()],
			'jam_akhir' => ['name' => 'jam_akhir', 'type' => Type::string()]
		];
	}
	public function resolve($root, $args)
	{
		if (isset($args['id'])) {
			return Workshift::where('id', $args['id'])->get();
		}elseif(isset($args['hari'])){
			return Workshift::where('hari', $args['hari'])->get();
		}elseif(isset($args['jam_mulai'])){
			return Workshift::where('jam_mulai', $args['jam_mulai'])->get();
		}elseif(isset($args['jam_akhir'])){
			return Workshift::where('jam_akhir', $args['jam_akhir'])->get();
		}else{
			return Workshift::all();
		}
	}

}