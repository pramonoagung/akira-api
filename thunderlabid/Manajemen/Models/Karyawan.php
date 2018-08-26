<?php

namespace Thunderlabid\Manajemen\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Karyawan extends Model
{
	public $table = "Karyawan";
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $fillable = ['nama','jenis_kelamin','rating'];

    public function penempatan(){
        return $this->hasMany('Thunderlabid\Manajemen\Models\Penempatan', 'karyawan_id');
	}

    public function rating(){
        return $this->hasMany('Thunderlabid\Terapis\Models\Rating', 'karyawan_id');
	}
	
	public function detail_reservasi(){
		return $this->hasMany('Thunderlabid\Reservasi\Models\ReservasiDetail', 'detail_reservasi_id');
	}

}