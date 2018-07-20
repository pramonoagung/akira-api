<?php 
namespace App\GraphQL\Query\Pembayaran;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Thunderlabid\Pembayaran\Models\Pembayaran;
/**
 * User Query
 */
class PembayaranQuery extends Query
{
	
	protected $attributes = [
		'name' => 'Pembayaran'
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
		if (isset($args['id'])) {
			return Pembayaran::where('id', $args['id'])->get();
		}elseif (isset($args['jenis'])) {
			return Pembayaran::where('jenis', $args['jenis'])->get();
		}elseif (isset($args['jumlah'])) {
			return Pembayaran::where('jumlah', $args['jumlah'])->get();
		}elseif (isset($args['referensi'])) {
			return Pembayaran::where('referensi', $args['referensi'])->get();
		}elseif (isset($args['id_header_transaksi'])) {
			return Pembayaran::where('id_header_transaksi', $args['id_header_transaksi'])->get();
		}else{
			return Pembayaran::all();
		}
	}
}