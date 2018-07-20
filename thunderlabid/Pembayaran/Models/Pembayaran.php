<?php

namespace Thunderlabid\Pembayaran\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembayaran extends Model
{
	public $table = "Pembayaran";
	use SoftDeletes;
	protected $dates = ['deleted_at'];
    protected $fillable = ['jenis','jumlah','referensi','id_header_transaksi'];

    public function header(){
    	return $this->belongsTo('Thunderlabid\Pembayaran\Models\HeaderTransaksi','id_header_transaksi');
    }
    public function detail(){
    	return $this->belongsTo('Thunderlabid\Pembayaran\Models\DetailTransaksi', 'id_header_transaksi');
    }
}