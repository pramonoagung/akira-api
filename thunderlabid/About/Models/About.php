<?php

namespace Thunderlabid\About\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class About extends Model
{
	public $table = "About";
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $fillable = ['nama','alamat','kontak'];

}