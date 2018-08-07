<?php 
namespace App\GraphQL\Mutation\Voucher;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Voucher\Models\Voucher;
use Illuminate\Support\Facades\DB;
use Thunderlabid\Otorisasi\Models\User;
use GraphQL\Type\Definition\ResolveInfo;
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
		return GraphQL::type('VoucherType');
	}
	public function args()
	{
		return [
			'kode' => ['name' => 'kode', 'type' => Type::nonNull(Type::string())],
			'jenis' => ['name' => 'jenis', 'type' => Type::nonNull(Type::string())],
			'jumlah' => ['name' => 'jumlah', 'type' => Type::string()],
			'syarat' => ['name' => 'syarat', 'type' => Type::string()],
			'tanggal_kadaluarsa' => ['name' => 'tanggal_kadaluarsa', 'type' => Type::nonNull(Type::string())],
			'logo_voucher' => ['name' => 'logo_voucher', 'type' => Type::string()],
			'logo_qr' => ['name' => 'logo_qr', 'type' => Type::string()],
		];
	}
	public function resolve($root, $args, $context, ResolveInfo $info)
	{
		try{
			$cek   = Voucher::where('kode',$args['kode'])->first();

        	if($cek) {
            	dd('exist');
        	}

            DB::beginTransaction();
            $voucher = new Voucher;
            $voucher->kode = $args['kode'];
            $voucher->jenis = $args['jenis'];
            $voucher->jumlah = $args['jumlah'];
            $voucher->syarat = $args['syarat'];
            $voucher->tanggal_kadaluarsa = $args['tanggal_kadaluarsa'];
            $voucher->logo_voucher = $args['logo_voucher'];
            $voucher->logo_qr = $args['logo_qr'];
            $voucher->status = 1;
            $voucher->owner_id = 1;
            $voucher->save();
            
            DB::Commit();
            return $voucher;
        }catch(\Exception $e){
            DB::Rollback();
        }      
	}
}