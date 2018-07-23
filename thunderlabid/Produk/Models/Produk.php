<?php

namespace Thunderlabid\Produk\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use SoftDeletes;

    protected $table = "produk";

    protected $fillable = [
        'nama', 'kode', 'waktu', 'harga', 'deskripsi'
    ];
}