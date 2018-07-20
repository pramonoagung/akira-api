<?php

namespace Thunderlabid\Voucher\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kepemilikan extends Model
{
	public $table = "Kepemilikan";
	use SoftDeletes;
	protected $dates = ['deleted_at'];
    protected $fillable = ['tanggal','pemilik'];

    public function voucher(){
    	return $this->belongsTo('Thunderlabid\Voucher\Models\Voucher','id_voucher');
    }
}