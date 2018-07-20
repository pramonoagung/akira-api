<?php

namespace Thunderlabid\Pembayaran\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HeaderTransaksi extends Model
{
	public $table = "Header_transaksi";
	use SoftDeletes;
	protected $dates = ['deleted_at'];
    protected $fillable = ['nomor','tanggal'];

    public function pembayaran(){
    	return $this->hasMany('Thunderlabid\Pembayaran\Models\Pembayaran', 'id_header_transaksi');
    }

    public function detail(){
    	return $this->hasMany('Thunderlabid\Pembayaran\Models\DetailTransaksi', 'id_header_transaksi');
    }
}