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
			'jumlah' => ['name' => 'jumlah', 'type' => Type::string()],
			'pemilik' => ['name' => 'pemilik', 'type' => Type::string()],
			'tanggal_kadaluarsa' => ['name' => 'tanggal_kadaluarsa', 'type' => Type::nonNull(Type::string())],
			'logo_voucher' => ['name' => 'logo_voucher', 'type' => Type::string()],
		];
	}
	public function resolve($root, $args, $context, ResolveInfo $info)
	{	
		try{
			$cek   = Voucher::where('kode',$args['kode'])->first();

        	if($cek) {
            	return "Voucher Exist";
        	}else
	        {
	            DB::beginTransaction();
	            $voucher = new Voucher;
	            $voucher->kode = $args['kode'];
	            $voucher->jumlah = $args['jumlah'];
	            $voucher->jenis = "diskon";
	            $voucher->syarat = "-";
	            $voucher->tanggal_kadaluarsa = $args['tanggal_kadaluarsa'];
	            $voucher->logo_voucher = $args['logo_voucher'];
	            $voucher->status = 1;
				$voucher->owner_id = $args['pemilik'];//id user bukan username -> makanya failed
	            $voucher->save();
	            
	            DB::Commit();
	            return $voucher;
	        }
        }catch(\Exception $e){
            DB::Rollback();
        }      
	}
}