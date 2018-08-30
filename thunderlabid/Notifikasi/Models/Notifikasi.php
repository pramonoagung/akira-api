<?php

namespace Thunderlabid\Notifikasi\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notifikasi extends Model
{
    use SoftDeletes;
    
    protected $table = "notifikasi";
    
    protected $fillable = [
        'token', 'title', 'body'
    ];
}