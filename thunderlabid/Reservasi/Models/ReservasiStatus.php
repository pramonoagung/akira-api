<?php

namespace thunderlabid\Reservasi\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservasiStatus extends Model
{
    use SoftDeletes;

    protected $table = "status_reservasi";

    protected $fillable = [
        'tanggal', 'status', 'progress', 'header_reservasi_id'
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function header_reservasi()
    {
        return $this->belongsTo('thunderlabid\Reservasi\Models\ReservasiHeader', 'header_reservasi_id');
    }
}