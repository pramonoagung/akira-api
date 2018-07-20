<?php 
namespace App\GraphQL\Mutation\Pembayaran;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Pembayaran\Models\DetailTransaksi;
/**
 * User Query
 */
class CreateDetail extends Mutation
{
	
	protected $attributes = [
		'name' => 'CreateDetail'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('DetailType'));
	}
	public function args()
	{
		return [
			'ref_id' => ['name' => 'ref_id', 'type' => Type::string()],
			'produk' => ['name' => 'produk', 'type' => Type::string()],
			'kuantitas' => ['name' => 'kuantitas', 'type' => Type::string()],
			'harga' => ['name' => 'harga', 'type' => Type::string()],
			'diskon' => ['name' => 'diskon', 'type' => Type::string()],
			'id_header_transaksi' => ['name' => 'id_header_transaksi', 'type' => Type::int()]
		];
	}
	public function resolve($root, $args)
	{
		DetailTransaksi::create($args);

		return DetailTransaksi::all();
	}
}