<?php 
namespace App\GraphQL\Query\Pembayaran;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Thunderlabid\Pembayaran\Models\HeaderTransaksi;
/**
 * User Query
 */
class HeaderQuery extends Query
{
	
	protected $attributes = [
		'name' => 'Header_transaksi'
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
		if (isset($args['id'])) {
			return HeaderTransaksi::where('id', $args['id'])->get();
		}elseif(isset($args['nomor'])){
			return HeaderTransaksi::where('nomor', $args['nomor'])->get();
		}elseif(isset($args['tanggal'])){
			return HeaderTransaksi::where('tanggal', $args['tanggal'])->get();
		}else{
			return HeaderTransaksi::all();
		}
	}

}