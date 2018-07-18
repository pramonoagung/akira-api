<?php

namespace Thunderlabid\Reservasi\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservasiHeader extends Model
{
    use SoftDeletes;
    
    protected $table = "header_reservasi";
    
    protected $fillable = [
        'tanggal_reservasi', 'tamu', 'kode'
    ];
    
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    
    public function detail_reservasi()
    {
        return $this->hasMany('Thunderlabid\Reservasi\Models\ReservasiDetail', 'header_reservasi_id');
    }     
    
    public function status_reservasi()
    {
        return $this->hasMany('Thunderlabid\Reservasi\Models\ReservasiStatus', 'header_reservasi_id');
    }

}