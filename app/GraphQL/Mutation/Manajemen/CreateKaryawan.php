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
			'nama' => ['name' => 'nama', 'type' => Type::string()],
      'jenis_kelamin' => ['name' => 'jenis_kelamin', 'type' => Type::string()]
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
            $karyawan->nama = $args['nama'];
            $karyawan->jenis_kelamin = $args['jenis_kelamin'];
            $karyawan->save();
            $karyawan->nip = 1000000 + $karyawan->id;
            $karyawan->save();
            
            $penempatan->posisi = "AKIRA-PUSAT";
            $penempatan->tanggal_mulai = date('y-m-d h:i:s');
            $penempatan->tanggal_berakhir = date('y-m-d h:i:s',strtotime('+1 years'));
            $penempatan->karyawan_id = $karyawan->id;
            $penempatan->save();

            $hari = ['senin', 'selasa', 'rabu', 'kamis', 'jumat','sabtu','minggu'];
            foreach($hari as $item){
                  $workshift = Workshift::create([
                      'hari' => $item,
                      'jam_mulai' => '10:00:00',
                      'jam_akhir' => '22:00:00',
                      'penempatan_id' =>$penempatan->id
                  ]);
            }

            foreach($hari as $item){
                  $ketersediaanterapis = KetersediaanTerapis::create([
                      'hari' => $item,
                      'jam_mulai' => '10:00:00',
                      'jam_akhir' => '22:00:00',
                      'penempatan_id' => $penempatan->id
                  ]);
            }
            
            DB::Commit();
            return $karyawan;
        }catch(\Exception $e){
            DB::Rollback();
        }      
	}

}