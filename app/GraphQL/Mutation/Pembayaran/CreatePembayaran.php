<?php 
namespace App\GraphQL\Mutation\Pembayaran;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Pembayaran\Models\Pembayaran;
use Thunderlabid\Voucher\Models\Voucher;
use App\Events\CheckVoucherEvent;
/**
 * User Query
 */
class CreatePembayaran extends Mutation
{
	
	protected $attributes = [
		'name' => 'CreatePembayaran'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('PembayaranType'));
	}
	public function args()
	{
		return [
			'jenis' => ['name' => 'jenis', 'type' => Type::string()],
			'jumlah' => ['name' => 'jumlah', 'type' => Type::string()],
			'referensi' => ['name' => 'referensi', 'type' => Type::string()],
			'id_header_transaksi' => ['name' => 'id_header_transaksi', 'type' => Type::int()],
		];
	}
	public function resolve($root, $args)
	{
		// dd('Tunai');
		$bayar = Pembayaran::create($args);

		return $bayar;
		
		/*$voucher = Voucher::where('kode',$args['referensi'])->first();

        if($voucher) {
            Pembayaran::create($args);
			return Pembayaran::all();
        }else
        {
        	echo "voucher not Exists";
        }
		*/
	}
}