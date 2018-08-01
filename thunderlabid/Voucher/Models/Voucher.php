<?php

namespace Thunderlabid\Voucher\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
	public $table = "Voucher";
	use SoftDeletes;
	protected $dates = ['deleted_at'];
    protected $fillable = ['kode','jenis','syarat','tanggal_kadaluarsa','owner_id'];

    public function kepemilikan(){
    	return $this->hasMany('Thunderlabid\Voucher\Models\Kepemilikan', 'id_voucher');
    }

    public function owner(){
    	return $this->belongsTo('Thunderlabid\Otorisasi\Models\User', 'owner_id');
    }
    
}