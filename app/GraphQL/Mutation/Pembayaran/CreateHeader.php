<?php 
namespace App\GraphQL\Mutation\Pembayaran;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Pembayaran\Models\HeaderTransaksi;
use Thunderlabid\Pembayaran\Models\DetailTransaksi;
use Thunderlabid\Pembayaran\Models\Pembayaran;
use Thunderlabid\Reservasi\Models\ReservasiHeader;
use Thunderlabid\Reservasi\Models\ReservasiDetail;
use Thunderlabid\Reservasi\Models\ReservasiStatus;
use Thunderlabid\Produk\Models\Produk;
use GraphQL\Type\Definition\ResolveInfo;
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
			'ref_id' => ['name' => 'ref_id', 'type' => Type::string()],
			'tanggal' => ['name' => 'tanggal', 'type' => Type::string()],
			'jenis' => ['name' => 'jenis', 'type' => Type::string()],
			'jumlah' => ['name' => 'jumlah', 'type' => Type::string()],
			'referensi' => ['name' => 'referensi', 'type' => Type::string()],
			'diskon' => ['name' => 'diskon', 'type' => Type::string()]
		];
	}
	public function resolve($root, $args, $context, ResolveInfo $info)
	{
		// dd('here');
		$reservasi = ReservasiHeader::where('kode', $args['ref_id'])->first();
		if($reservasi){
			try{

				$dreservasi = ReservasiDetail::where('header_reservasi_id', $reservasi->id)->get();
				
				// dd($dreservasi[0]->produk_id);
	            DB::beginTransaction();
	            $header = new HeaderTransaksi;
	            $pembayaran = new Pembayaran;
	            $header->nomor = 123;
	            $header->tanggal = date("Y-m-d");
	            $header->save();

	            $inc = 100000 + $header->id;

	            $header->nomor = date('ymd')."HT".$inc; 
	            $header->save();

	            $i = 0;

	            foreach($dreservasi as $datas){
	            	$detail = new DetailTransaksi;
	            	$produk = Produk::where('id', $datas->produk_id)->first();
	            	$detail->ref_id = $args['ref_id'];
		            $detail->produk = $produk->nama;
		            $detail->kuantitas = 1;
		            $detail->harga = $produk->harga;
		            isset($args['diskon'])?$detail->diskon = $args['diskon']:'';
		            $detail->id_header_transaksi = $header->id;
		            $detail->save();
		            $i += 1;
	            } 
	            // dd($i);


	            $pembayaran->jenis = $args['jenis'];
	            $pembayaran->jumlah = $args['jumlah'];
	            isset($args['referensi'])? $pembayaran->referensi = $args['referensi']:'';
	            $pembayaran->id_header_transaksi = $header->id;
	            $pembayaran->save();

	            $status = ReservasiStatus::where('header_reservasi_id', $reservasi->id)->first();

	            $status->progress = "selesai";
	            $status->save();
	            
	            DB::Commit();
	            return $header;
	        }catch(\Exception $e){
	            DB::Rollback();
	        }
	    }else
	    {
	    	throw new \Exception("Kode Reservasi not Exists", 999);
	    }      
	}
}