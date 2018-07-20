<?php 
namespace App\GraphQL\Query\Pembayaran;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Thunderlabid\Pembayaran\Models\DetailTransaksi;
/**
 * User Query
 */
class DetailQuery extends Query
{
	
	protected $attributes = [
		'name' => 'Detail_transaksi'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('DetailType'));
	}
	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::int()],
			'ref_id' => ['name' => 'ref_id', 'type' => Type::string()],
			'produk' => ['name' => 'produk', 'type' => Type::string()],
			'kuantitas' => ['name' => 'kuantitas', 'type' => Type::string()],
			'harga' => ['name' => 'harga', 'type' => Type::string()],
			'diskon' => ['name' => 'diskon', 'type' => Type::string()]
		];
	}
	public function resolve($root, $args)
	{
		if (isset($args['id'])) {
			return DetailTransaksi::where('id', $args['id'])->get();
		}else if (isset($args['ref_id'])) {
			return DetailTransaksi::where('ref_id', $args['ref_id'])->get();
		}else if (isset($args['produk'])) {
			return DetailTransaksi::where('produk', $args['produk'])->get();
		}else if (isset($args['kuantitas'])) {
			return DetailTransaksi::where('kuantitas', $args['kuantitas'])->get();
		}else if (isset($args['harga'])) {
			return DetailTransaksi::where('harga', $args['harga'])->get();
		}else if (isset($args['diskon'])) {
			return DetailTransaksi::where('diskon', $args['diskon'])->get();
		}else{
			return DetailTransaksi::all();
		}
	}
}