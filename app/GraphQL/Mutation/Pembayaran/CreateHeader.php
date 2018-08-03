<?php 
namespace App\GraphQL\Mutation\Pembayaran;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Pembayaran\Models\HeaderTransaksi;

use GraphQL\Type\Definition\ResolveInfo;
use Thunderlabid\Pembayaran\Models\Pembayaran;
use Illuminate\Support\Facades\DB;
use Thunderlabid\Pembayaran\Models\DetailTransaksi;
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
			'nomor' => ['name' => 'nomor', 'type' => Type::string()],
			'tanggal' => ['name' => 'tanggal', 'type' => Type::string()],
			'jenis' => ['name' => 'jenis', 'type' => Type::string()],
			'jumlah' => ['name' => 'jumlah', 'type' => Type::string()],
			'referensi' => ['name' => 'referensi', 'type' => Type::string()],
			'ref_id' => ['name' => 'ref_id', 'type' => Type::string()],
			'produk' => ['name' => 'produk', 'type' => Type::string()],
			'kuantitas' => ['name' => 'kuantitas', 'type' => Type::string()],
			'harga' => ['name' => 'harga', 'type' => Type::string()],
			'diskon' => ['name' => 'diskon', 'type' => Type::string()]
		];
	}
	public function resolve($root, $args, $context, ResolveInfo $info)
	{
		// dd('here');
		try{
            DB::beginTransaction();
            $header = new HeaderTransaksi;
            $pembayaran = new Pembayaran;
            $detail = new DetailTransaksi;
            $header->nomor = $args['nomor'];
            $header->tanggal = $args['tanggal'];
            $header->save();
            
            $pembayaran->jenis = $args['jenis'];
            $pembayaran->jumlah = $args['jumlah'];
            $pembayaran->referensi = $args['referensi'];
            $pembayaran->id_header_transaksi = $header->id;
            $pembayaran->save();
            
            $detail->ref_id = $args['ref_id'];
            $detail->produk = $args['produk'];
            $detail->kuantitas = $args['kuantitas'];
            $detail->harga = $args['harga'];
            $detail->diskon = $args['diskon'];
            $detail->id_header_transaksi = $header->id;
            $detail->save();
            DB::Commit();
            return $header;
        }catch(\Exception $e){
            DB::Rollback();
        }      
	}
}