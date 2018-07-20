<?php 
namespace App\GraphQL\Mutation\Voucher;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Voucher\Models\Kepemilikan;
/**
 * User Query
 */
class CreateKepemilikan extends Mutation
{
	
	protected $attributes = [
		'name' => 'CreateKepemilikan'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('KepemilikanType'));
	}
	public function args()
	{
		return [
			'tanggal' => ['name' => 'tanggal', 'type' => Type::string()],
			'pemilik' => ['name' => 'pemilik', 'type' => Type::string()]
		];
	}
	public function resolve($root, $args)
	{
		Kepemilikan::create($args);

		return Kepemilikan::all();
	}
}