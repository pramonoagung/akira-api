<?php 
namespace App\GraphQL\Query\Manajemen;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use App\Events\CekTerapisEvent;
use Thunderlabid\Manajemen\Models\Penempatan;
use Thunderlabid\Manajemen\Models\Workshift;
use Thunderlabid\Manajemen\Models\Karyawan;
use Thunderlabid\Reservasi\Models\ReservasiDetail as RD;

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
			'durasi' => ['name' => 'durasi', 'type' => Type::nonNull(Type::string())]
		];
	}

	public function resolve($root, $args)
	{
 		//1. cek siapa yang bertugas (KARYAWAN_ID)
		$workshift = Penempatan::wherehas('workshift', function($q)use($args){$q->where('hari', $args['hari']);})->get(['karyawan_id']);
        $kid    = array_column($workshift->toarray(), 'karyawan_id');
        
        //2. cek terapis yg ada jadwal
        $dr     = RD::wherehas('header_reservasi', function($q)use($args){$q->where('tanggal_reservasi', $args['tanggal']);})
		->whereIn('karyawan_id', $kid)->get(['karyawan_id']);
        $tid    = array_column($dr->toarray(), 'karyawan_id');
		
        ///->where('tanggal_reservasi', $event->tanggal)
        //intersection, range
        //3. fetch their names
        $karyawan   = Karyawan::wherenotin('id', $tid)->get();
		return $karyawan;
	}

}