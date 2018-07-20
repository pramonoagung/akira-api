<?php 
namespace App\GraphQL\Mutation\Voucher;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Voucher\Models\Kepemilikan;
/**
 * User Query
 */
class UpdateKepemilikan extends Mutation
{
	
	protected $attributes = [
		'name' => 'UpdateKepemilikan'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('KepemilikanType'));
	}
	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::int()],
			'tanggal' => ['name' => 'tanggal', 'type' => Type::string()],
			'pemilik' => ['name' => 'pemilik', 'type' => Type::string()]
		];
	}
	public function resolve($root, $args)
	{
		$data = Kepemilikan::find($args['id']);

		$data->tanggal = $args['tanggal'];
		$data->pemilik = $args['pemilik'];
		
        $data->save();

		return Kepemilikan::all();
	}
}