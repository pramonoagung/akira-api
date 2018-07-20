<?php 
namespace App\GraphQL\Query\Voucher;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Thunderlabid\Voucher\Models\Kepemilikan;/**
 * User Query
 */
class KepemilikanQuery extends Query
{
	
	protected $attributes = [
		'name' => 'Kepemilikan'
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
		if (isset($args['id'])) {
			return Kepemilikan::where('id', $args['id'])->get();
		}else if (isset($args['tanggal'])) {
			return Kepemilikan::where('tanggal', $args['tanggal'])->get();
		}else if (isset($args['pemilik'])) {
			return Kepemilikan::where('pemilik', $args['pemilik'])->get();
		}else{
			return Saldo::all();
		}
	}
}