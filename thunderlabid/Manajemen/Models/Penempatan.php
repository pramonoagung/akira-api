<?php

namespace Thunderlabid\Manajemen\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penempatan extends Model
{
	public $table = "Penempatan";
	use SoftDeletes;
	protected $dates = ['deleted_at'];
    protected $fillable = ['nomor','tanggal'];

    public function penempatan(){
    	return $this->belongsTo('Thunderlabid\Manajemen\Models\Karyawan', 'karyawan_id');
    }

    public function workshift(){
        return $this->hasMany('Thunderlabid\Manajemen\Models\Workshift', 'penempatan_id');
    }

    public function ketersediaan(){
        return $this->hasMany('Thunderlabid\Manajemen\Models\ketersediaan_Terapis', 'penempatan_id');
    }


}