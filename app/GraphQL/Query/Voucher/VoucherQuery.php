<?php 
namespace App\GraphQL\Query\Voucher;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Thunderlabid\Voucher\Models\Voucher;
/**
 * User Query
 */
class VoucherQuery extends Query
{
	
	protected $attributes = [
		'name' => 'Voucher'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('VoucherType'));
	}
	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::int()],
			'kode' => ['name' => 'kode', 'type' => Type::string()],
			'jenis' => ['name' => 'jenis', 'type' => Type::string()],
			'syarat' => ['name' => 'syarat', 'type' => Type::string()],
			'tanggal_kadaluarsa' => ['name' => 'tanggal_kadaluarsa', 'type' => Type::string()],
			'owner_id' => ['name' => 'owner_id', 'type' => Type::int()],
		];
	}
	public function resolve($root, $args)
	{
		if (isset($args['id'])) {
			return Voucher::where('id', $args['id'])->get();
		}else if (isset($args['kode'])) {
			return Voucher::where('kode', $args['kode'])->get();
		}else if (isset($args['jenis'])) {
			return Voucher::where('jenis', $args['jenis'])->get();
		}else if (isset($args['syarat'])) {
			return Voucher::where('syarat', $args['syarat'])->get();
		}else if (isset($args['tanggal_kadaluarsa'])) {
			return Voucher::where('tanggal_kadaluarsa', $args['tanggal_kadaluarsa'])->get();
		}else{
			return Voucher::all();
		}
	}
}