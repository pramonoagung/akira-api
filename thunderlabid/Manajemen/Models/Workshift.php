<?php

namespace Thunderlabid\Manajemen\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workshift extends Model
{
	public $table = "Workshift";
	use SoftDeletes;
	protected $dates = ['deleted_at'];
    protected $fillable = ['hari','jam_mulai','jam_akhir','penempatan_id'];

    public function penempatanworkshift(){
    	return $this->belongsTo('Thunderlabid\Manajemen\Models\Penempatan', 'penempatan_id');
    }
}