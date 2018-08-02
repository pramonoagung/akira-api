<?php 
namespace App\GraphQL\Mutation\Manajemen;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Manajemen\Models\Penempatan;
/**
 * User Query
 */
class UpdatePenempatan extends Mutation
{
	
	protected $attributes = [
		'name' => 'UpdatePenempatan'
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
		$data = Penempatan::find($args['id']);

		$data->posisi = $args['posisi'];
		$data->tanggal_mulai = $args['tanggal_mulai'];
		$data->tanggal_berakhir = $args['tanggal_berakhir'];

        $data->save();

		return Penempatan::all();
	}
}