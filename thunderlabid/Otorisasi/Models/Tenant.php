<?php

namespace Thunderlabid\Otorisasi\Models;

/*
	Frameworks
 */
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/*
	Traits
 */
use Thunderlabid\Otorisasi\Models\Traits\HasUUIDModelTrait;

/*
	Exception
 */

class Tenant extends Model
{
	use SoftDeletes, HasUUIDModelTrait;

	protected $table            = 'o_tenants';

	protected $fillable         =   [
										'uuid',
										'nama',
									];

	protected $dates            =   [  
										'deleted_at',
									];

	public $rules               =   [
                                        'uuid'          => ['required', 'unique'],
										'nama'			=> ['required', 'string', 'max:255'],
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

	// ----------------------------------------------------------------------------------------------------
	// ACCESSOR
	// ----------------------------------------------------------------------------------------------------
	
	// ----------------------------------------------------------------------------------------------------
	// FUNCTION
	// ----------------------------------------------------------------------------------------------------
	public function getScopes($user_id = null){
		$scopes 	= Scope::where('tenant_id', $this->id);

		if(!is_null($user_id)){
			$scopes = $scopes->where('user_id', $user_id);
		}

		return $scopes->get();
	}
	
	// ----------------------------------------------------------------------------------------------------
	// SCOPE
	// ----------------------------------------------------------------------------------------------------
	public function scopeBetween($q, \Carbon\Carbon $date1, \Carbon\Carbon $date2)
	{
		return $q->where('created_at', '>=', $date1)
			  	 ->where('created_at', '<=', $date2);
	}
}
