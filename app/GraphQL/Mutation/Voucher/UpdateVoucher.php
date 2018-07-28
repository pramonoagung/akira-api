<?php 
namespace App\GraphQL\Mutation\Voucher;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Voucher\Models\Voucher;
/**
 * User Query
 */
class UpdateVoucher extends Mutation
{
	
	protected $attributes = [
		'name' => 'UpdateVoucher'
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
			'tanggal_kadaluarsa' => ['name' => 'tanggal_kadaluarsa', 'type' => Type::string()]
		];
	}
	public function resolve($root, $args)
	{
		$data = Voucher::find($args['id']);

		$data->kode = $args['kode'];
		$data->jenis = $args['jenis'];
		$data->syarat = $args['syarat'];
		$data->tanggal_kadaluarsa = $args['tanggal_kadaluarsa'];
		
        $data->save();

		return Voucher::all();
	}
}