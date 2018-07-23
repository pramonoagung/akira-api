<?php

namespace Thunderlabid\Terapis\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Terapis extends Model
{
    use SoftDeletes;

    protected $table = "terapis";

    protected $fillable = [
        'nama', 'status',
    ];
}