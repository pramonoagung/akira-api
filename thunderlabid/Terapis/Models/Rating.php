<?php

namespace Thunderlabid\Terapis\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rating extends Model
{
    use SoftDeletes;
    
    protected $table = "Rating";
    
    protected $fillable = [
        'karyawan_id', 'user_id', 'rating', 'komentar'
    ];
    
    public function karyawan()
    {
        return $this->belongsTo('Thunderlabid\Manajemen\Models\Karyawan','karyawan_id');
    }
}