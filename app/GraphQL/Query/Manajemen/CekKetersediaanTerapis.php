<?php 
namespace App\GraphQL\Query\Manajemen;
use GraphQL, DB;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\Events\CekTerapisEvent;
use Thunderlabid\Manajemen\Models\Penempatan;
use Thunderlabid\Manajemen\Models\Workshift;
use Thunderlabid\Manajemen\Models\Karyawan;
use Thunderlabid\Reservasi\Models\ReservasiDetail as RD;
use Thunderlabid\Reservasi\Models\ReservasiStatus as RS;
use Thunderlabid\Reservasi\Models\ReservasiHeader as RH;

/**
 * User Query
 */
class CekKetersediaanTerapis extends Query
{
	
	protected $attributes = [
		'name' => 'CekKetersediaanTerapis'
	];
	public function type()
	{
		return Type::listOf(GraphQL::type('CekKetersediaanTerapisType'));
	}

	public function args()
	{
		return [
			'hari' => ['name' => 'hari', 'type' => Type::nonNull(Type::string())],
			'tanggal' => ['name' => 'tanggal', 'type' => Type::nonNull(Type::string())],
			'jam_berakhir' => ['name' => 'jam_berakhir', 'type' => Type::nonNull(Type::string())],
			'jk' => ['name' => 'jk', 'type' => Type::nonNull(Type::string())]
		];
	}

	public function resolve($root, $args)
	{
		$waktuReservasi = date("H:i:s",strtotime($args['tanggal']));
		$tanggalReservasi = date("Y-m-d",strtotime($args['tanggal']));
		
		$tglWktSelesai = $tanggalReservasi.' '.$args['jam_berakhir'];
		//1. cek siapa yang bertugas (KARYAWAN_ID)
		//Cari yg flag = 1 dan hari = $args['hari]
		$terapisId = Karyawan::where('jenis_kelamin', $args['jk'])->
		wherehas('penempatan', function($q)use($args){$q->wherehas('workshift', function($v)use($args){$v->where('hari', $args['hari'])->where('flag',1);});})->get(['id']);
		$kid    = array_column($terapisId->toarray(), 'id');
		
		//cocokin interval waktu tanggal dan waktu reservasi dengan resrvasi yang udah diterima
		//trus ambil karyawan_id nya
		$karyawanBertugas = DB::table('header_reservasi')
			->join('status_reservasi', 'header_reservasi.id', '=', 'status_reservasi.header_reservasi_id')
            ->join('detail_reservasi', 'header_reservasi.id', '=', 'detail_reservasi.header_reservasi_id')
			->where('status_reservasi.status','=','diterima')
			->where('status_reservasi.progress','!=','selesai')
			->where('header_reservasi.tanggal_reservasi','>=',$args['tanggal'])
			->where('header_reservasi.tanggal_reservasi','<=',$tglWktSelesai)
            ->select('detail_reservasi.karyawan_id')
			->get();
		$tid    = array_column($karyawanBertugas->toarray(), 'karyawan_id');
		
	    $karyawan   = Karyawan::wherenotin('id', $tid)->get();
		return $karyawan;
	}

}