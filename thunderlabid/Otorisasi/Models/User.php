<?php

namespace Thunderlabid\Otorisasi\Models;

/*
	Frameworks
 */
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\Hash;

/*
	Exception
 */

class User extends Model
{
	use SoftDeletes;

	protected $table            = 'o_users';

	protected $fillable         =   [
										'username',
										'password',
									];

	protected $dates            =   [  
										'deleted_at',
									];

	public $rules               =   [
                                        'username'          => ['required', 'unique'],
										'password'			=> ['required', 'string', 'max:255'],
									];
									
	protected $casts			=	[
									];

	public $timestamps        	=   true;

	// ----------------------------------------------------------------------------------------------------
	// BOOT
	// ----------------------------------------------------------------------------------------------------

	// ----------------------------------------------------------------------------------------------------
	// CONSTRUCT
	// ----------------------------------------------------------------------------------------------------

	// ----------------------------------------------------------------------------------------------------
	// RELATION
	// ----------------------------------------------------------------------------------------------------
	public function scopes() 
	{
		return $this->hasMany(Scope::class);
	}

	// ----------------------------------------------------------------------------------------------------
	// MUTATOR
	// ----------------------------------------------------------------------------------------------------
	public function setPasswordAttribute($value){
		if (Hash::needsRehash($value)) {
			$this->attributes['password'] = Hash::make($value); 
		}else{
			$this->attributes['password'] = $value; 
		}
	}
	// ----------------------------------------------------------------------------------------------------
	// ACCESSOR
	// ----------------------------------------------------------------------------------------------------
	
	// ----------------------------------------------------------------------------------------------------
	// FUNCTION
	// ----------------------------------------------------------------------------------------------------
	public function getTenants(){
		return Tenant::whereHas('scopes', function($q){$q->where('user_id', $this->id);})->get();
	}
	
	// ----------------------------------------------------------------------------------------------------
	// SCOPE
	// ----------------------------------------------------------------------------------------------------
	public function scopeUsername($q, String $v)
	{
		return $q->where('username', $v);
	}

	public function scopeBetween($q, \Carbon\Carbon $date1, \Carbon\Carbon $date2)
	{
		return $q->where('created_at', '>=', $date1)
			  	 ->where('created_at', '<=', $date2);
	}

	public function voucherlist(){
    	return $this->hasMany('Thunderlabid\Voucher\Models\Voucher','owner_id');
    }
}
