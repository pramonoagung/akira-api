<?php 
namespace App\GraphQL\Mutation\Manajemen;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Manajemen\Models\KetersediaanTerapis;
use Thunderlabid\Manajemen\Models\Workshift;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\DB;
/**
 * User Query
 */
class CreateWorkshift extends Mutation
{
	
	protected $attributes = [
		'name' => 'CreateWorkshift'
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
	public function resolve($root, $args, $context, ResolveInfo $info)
	{

		Workshift::create($args);

		KetersediaanTerapis::create($args);

		return Workshift::all();
	}
}