<?php 
namespace App\GraphQL\Mutation\Manajemen;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Manajemen\Models\KetersediaanTerapis;
/**
 * User Query
 */
class CreateKetersediaanTerapis extends Mutation
{
	
	protected $attributes = [
		'name' => 'CreateKetersediaanTerapis'
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
			'jam_akhir' => ['name' => 'jam_akhir', 'type' => Type::string()]
		];
	}
	public function resolve($root, $args)
	{

		KetersediaanTerapis::create($args);

		return KetersediaanTerapis::all();
	}
}