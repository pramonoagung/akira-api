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
			'kode' => ['name' => 'kode', 'type' => Type::nonNull(Type::string())],
			'jenis' => ['name' => 'jenis', 'type' => Type::nonNull(Type::string())],
			'jumlah' => ['name' => 'jumlah', 'type' => Type::string()],
			'syarat' => ['name' => 'syarat', 'type' => Type::string()],
			'tanggal_kadaluarsa' => ['name' => 'tanggal_kadaluarsa', 'type' => Type::nonNull(Type::string())],
			'logo_voucher' => ['name' => 'logo_voucher', 'type' => Type::string()],
			'logo_qr' => ['name' => 'logo_qr', 'type' => Type::string()],
		];
	}
	public function resolve($root, $args)
	{
		$data = Voucher::find($args['id']);

		$data->kode = $args['kode'];
		$data->jenis = $args['jenis'];
		$data->jumlah = $args['jumlah'];
		$data->syarat = $args['syarat'];
		$data->tanggal_kadaluarsa = $args['tanggal_kadaluarsa'];
		$data->logo_voucher = $args['logo_voucher'];
		$data->logo_qr = $args['logo_qr'];

		
        $data->save();

		return Voucher::all();
	}
}