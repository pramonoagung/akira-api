<?php

namespace Thunderlabid\Reservasi\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservasiDetail extends Model
{
    use SoftDeletes;

    protected $table = "detail_reservasi";

    protected $fillable = [
        'durasi', 'produk', 'terapis', 'header_reservasi_id'
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function header_reservasi()
    {
        return $this->belongsTo('thunderlabid\Reservasi\Models\ReservasiHeader', 'header_reservasi_id');
    }
}