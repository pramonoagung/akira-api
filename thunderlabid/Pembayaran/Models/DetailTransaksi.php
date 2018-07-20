<?php

namespace Thunderlabid\Pembayaran\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailTransaksi extends Model
{
	public $table = "Detail_transaksi";

	use SoftDeletes;
	protected $dates = ['deleted_at'];
    protected $fillable = ['ref_id','produk','kuantitas','harga','diskon','id_header_transaksi'];

    public function header(){
    	return $this->belongsTo('Thunderlabid\Pembayaran\Models\HeaderTransaksi','id_header_transaksi');
    }
}