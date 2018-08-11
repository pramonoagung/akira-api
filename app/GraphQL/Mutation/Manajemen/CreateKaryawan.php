<?php 
namespace App\GraphQL\Mutation\Manajemen;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\DB;
use Thunderlabid\Manajemen\Models\Karyawan;
use Thunderlabid\Manajemen\Models\KetersediaanTerapis;
use Thunderlabid\Manajemen\Models\Workshift;
use Thunderlabid\Manajemen\Models\Penempatan;
/**
 * User Query
 */
class CreateKaryawan extends Mutation
{
	
	protected $attributes = [
		'name' => 'CreateKaryawan'
	];
	public function type()
	{
		return GraphQL::type('KaryawanType');
	}
	public function args()
	{
		return [
			'uuid' => ['name' => 'uuid', 'type' => Type::string()],
			'nip' => ['name' => 'nip', 'type' => Type::string()],
			'nama' => ['name' => 'nama', 'type' => Type::string()]
		];
	}

	public function resolve($root, $args, $context, ResolveInfo $info)
	{
		// dd('here');
		try{
			// dd(date('y-m-d h:i:s'));
            DB::beginTransaction();
            $karyawan = new Karyawan;
            $penempatan = new Penempatan;
            $workshift = new Workshift;
            $ketersediaanterapis = new KetersediaanTerapis;
            $karyawan->uuid = $args['uuid'];
            $karyawan->nip = $args['nip'];
            $karyawan->nama = $args['nama'];
            $karyawan->save();
            
            $penempatan->posisi = "AKIRA-PUSAT";
            $penempatan->tanggal_mulai = date('y-m-d h:i:s');
            $penempatan->tanggal_berakhir = date('y-m-d h:i:s',strtotime('+1 years'));
            $penempatan->karyawan_id = $karyawan->id;
            $penempatan->save();

            $workshift->hari = "Senin";
            $workshift->jam_mulai = "08:00:00";
            $workshift->jam_akhir = "16:00:00";
            $workshift->penempatan_id = $penempatan->id;
            $workshift->save();

            $ketersediaanterapis->hari = "AKIRA-PUSAT";
            $ketersediaanterapis->jam_mulai = "08:00:00";
            $ketersediaanterapis->jam_akhir = "16:00:00";
            $ketersediaanterapis->penempatan_id = $penempatan->id;
            $ketersediaanterapis->save();
            
            DB::Commit();
            return $karyawan;
        }catch(\Exception $e){
            DB::Rollback();
        }      
	}

}