<?php 
namespace App\GraphQL\Mutation\Manajemen;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Manajemen\Models\Penempatan;
/**
 * User Query
 */
class CreatePenempatan extends Mutation
{
	
	protected $attributes = [
		'name' => 'CreatePenempatan'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('PenempatanType'));
	}
	public function args()
	{
		return [
			'posisi' => ['name' => 'posisi', 'type' => Type::string()],
			'tanggal_mulai' => ['name' => 'tanggal_mulai', 'type' => Type::string()],
			'tanggal_berakhir' => ['name' => 'tanggal_berakhir', 'type' => Type::string()]
		];
	}
	public function resolve($root, $args)
	{

		Penempatan::create($args);

		return Penempatan::all();
	}
}