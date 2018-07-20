<?php 
namespace App\GraphQL\Mutation\Pembayaran;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Pembayaran\Models\Pembayaran;
/**
 * User Query
 */
class UpdatePembayaran extends Mutation
{
	
	protected $attributes = [
		'name' => 'UpdatePembayaran'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('PembayaranType'));
	}
	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::int()],
			'jenis' => ['name' => 'jenis', 'type' => Type::string()],
			'jumlah' => ['name' => 'jumlah', 'type' => Type::string()],
			'referensi' => ['name' => 'referensi', 'type' => Type::string()],
			'id_header_transaksi' => ['name' => 'id_header_transaksi', 'type' => Type::int()],
		];
	}
	public function resolve($root, $args)
	{
		$data = Pembayaran::find($args['id']);

		$data->jenis = $args['jenis'];
		$data->jumlah = $args['jumlah'];
		$data->referensi = $args['referensi'];
		$data->id_header_transaksi = $args['id_header_transaksi'];
		
        $data->save();

		return Pembayaran::all();
	}
}