<?php 
namespace App\GraphQL\Mutation\Pembayaran;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Pembayaran\Models\HeaderTransaksi;
/**
 * User Query
 */
class UpdateHeader extends Mutation
{
	
	protected $attributes = [
		'name' => 'UpdateHeader'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('HeaderType'));
	}
	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::int()],
			'nomor' => ['name' => 'nomor', 'type' => Type::string()],
			'tanggal' => ['name' => 'tanggal', 'type' => Type::string()]
		];
	}
	public function resolve($root, $args)
	{
		$data = HeaderTransaksi::find($args['id']);

		$data->nomor = $args['nomor'];
		$data->tanggal = $args['tanggal'];
		
        $data->save();

		return HeaderTransaksi::all();
	}
}