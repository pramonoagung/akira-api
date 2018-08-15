<?php 
namespace App\GraphQL\Mutation\Pembayaran;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Pembayaran\Models\HeaderTransaksi;

use GraphQL\Type\Definition\ResolveInfo;
use Thunderlabid\Pembayaran\Models\Pembayaran;
use Illuminate\Support\Facades\DB;
use App\Events\CheckVoucherEvent;
/**
 * User Query
 */
class CreateHeader extends Mutation
{
	
	protected $attributes = [
		'name' => 'CreateHeader'
	];
	public function type()
	{
		return GraphQL::type('HeaderType');
	}
	public function args()
	{
		return [
			'tanggal' => ['name' => 'tanggal', 'type' => Type::string()],
			'jenis' => ['name' => 'jenis', 'type' => Type::string()],
			'jumlah' => ['name' => 'jumlah', 'type' => Type::string()],
			'referensi' => ['name' => 'referensi', 'type' => Type::string()]
		];
	}
	public function resolve($root, $args, $context, ResolveInfo $info)
	{
		// dd('here');
		try{
            DB::beginTransaction();
            $header = new HeaderTransaksi;
            $pembayaran = new Pembayaran;
            $header->nomor = 123;
            $header->tanggal = $args['tanggal'];
            $header->save();

            $inc = 100000 + $header->id;

            $header->nomor = date('ymd')."HT".$inc; 
            $header->save();
            
            $pembayaran->jenis = $args['jenis'];
            $pembayaran->jumlah = $args['jumlah'];
            $pembayaran->referensi = $args['referensi'];
            $pembayaran->id_header_transaksi = $header->id;
            $pembayaran->save();
            
            DB::Commit();
            return $header;
        }catch(\Exception $e){
            DB::Rollback();
        }      
	}
}