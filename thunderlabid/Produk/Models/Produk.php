<?php

namespace Thunderlabid\Produk\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = "produk";

    protected $fillable = [
        'nama', 'waktu', 'harga', 'deskripsi'
    ];
}