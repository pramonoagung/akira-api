<?php

namespace thunderlabid\Reservasi\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservasiHeader extends Model
{
    use SoftDeletes;
    
    protected $table = "header_reservasi";
    
    protected $fillable = [
        'tanggal_reservasi', 'tamu',
    ];
    
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    
    public function detail_reservasi()
    {
        return $this->hasMany('thunderlabid\Reservasi\Models\ReservasiDetail', 'detail_reservasi_id');
    }     
    
    public function status_reservasi()
    {
        return $this->hasMany('thunderlabid\Reservasi\Models\ReservasiStatus', 'status_reservasi_id');
    }

}