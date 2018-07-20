<?php 
namespace App\GraphQL\Mutation\Voucher;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Voucher\Models\Voucher;
/**
 * User Query
 */
class CreateVoucher extends Mutation
{
	
	protected $attributes = [
		'name' => 'CreateVoucher'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('VoucherType'));
	}
	public function args()
	{
		return [
			'kode' => ['name' => 'kode', 'type' => Type::string()],
			'jenis' => ['name' => 'jenis', 'type' => Type::string()],
			'syarat' => ['name' => 'syarat', 'type' => Type::string()],
			'tanggal_kadaluarsa' => ['name' => 'tanggal_kadaluarsa', 'type' => Type::int()],
		];
	}
	public function resolve($root, $args)
	{
		Voucher::create($args);

		return Voucher::all();
	}
}