<?php

namespace Thunderlabid\Otorisasi\Models;

/*
	Frameworks
 */
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/*
	Exception
 */

class Application extends Model
{
	use SoftDeletes;

	protected $table            = 'o_apps';

	protected $fillable         =   [
										'nama',
										'token',
									];

	protected $dates            =   [  
										'deleted_at',
									];

	public $rules               =   [
                                        'token'		=> ['required', 'unique'],
										'nama'		=> ['required', 'string'],
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

	// ----------------------------------------------------------------------------------------------------
	// MUTATOR
	// ----------------------------------------------------------------------------------------------------

	// ----------------------------------------------------------------------------------------------------
	// ACCESSOR
	// ----------------------------------------------------------------------------------------------------
	
	// ----------------------------------------------------------------------------------------------------
	// FUNCTION
	// ----------------------------------------------------------------------------------------------------
	
	// ----------------------------------------------------------------------------------------------------
	// SCOPE
	// ----------------------------------------------------------------------------------------------------
}