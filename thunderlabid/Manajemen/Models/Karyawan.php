<?php

namespace Thunderlabid\Manajemen\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Karyawan extends Model
{
	public $table = "Karyawan";
	use SoftDeletes;
	protected $dates = ['deleted_at'];
    protected $fillable = ['nomor','tanggal'];

    public function penempatan(){
        return $this->hasMany('Thunderlabid\Manajemen\Models\Karyawan', 'karyawan_id');
    }

}