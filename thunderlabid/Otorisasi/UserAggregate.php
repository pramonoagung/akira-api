<?php

namespace Thunderlabid\Otorisasi;

use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;


/////////////////
// Application //
/////////////////
// Model
use Thunderlabid\Otorisasi\Models\User as Model;

// Aggregates

class UserAggregate extends BaseAggregate {

	public function __construct(Model $data)
	{
		if (!$data->id) throw new ModelNotFoundException("Data not found");
		$this->data = $data;
	}

	// ##############################################################################################################################################################################################
	// FACTORY
	// ##############################################################################################################################################################################################
	public static function create(array $attr)
	{
		////////////
		// Create //
		////////////
		DB::beginTransaction();
		$data = Model::create($attr);
		DB::commit();

		////////////
		// Return //
		////////////
		return new Self($data);
	}

	public static function find(int $id)
	{
		//////////////
		// Retrieve //
		//////////////
		$data = Model::withTrashed()->findorfail($id);

		////////////
		// Return //
		////////////
		return new Self($data);
	}

	public static function findByUUID(String $uuid)
	{
		//////////////
		// Retrieve //
		//////////////
		$data = Model::withTrashed()->uuid($uuid)->firstorfail();

		////////////
		// Return //
		////////////
		return new Self($data);
	}

	/**
	* Untuk menambah tenant dan owner
	*
	* @param String $nama nama tenant 
	*
	*/
	public function add_tenant(String $nama)
	{
		//////////////
		// Policies //
		//////////////

		////////
		// Do //
		////////
		DB::beginTransaction();
		$this->data->tenants()->create(['nama' => $nama]);

		//GET TENANT ADDED
		$tenant 	= $this->data->tenants->orderby('created_at', 'desc')->last();

		//ADD DEFAULT ROLE
		$default 	= config()->get('otorisasi.owner.default');
		foreach ($default as $k => $v) {
			$this->data->scopes()->create(['tenant_id' => $tenant->id, 'scope' => $v]);
		}
		DB::commit();

		//////////////
		// Retrieve //
		//////////////

		////////////
		// Return //
		////////////
	}

	/**
	* Untuk menghapus tenant dan owner
	*
	* @param String $uuid id tenant 
	*
	*/
	public function remove_tenant(String $uuid)
	{
		//////////////
		// Policies //
		//////////////

		////////
		// Do //
		////////
		DB::beginTransaction();
		$tenant 	= $this->data->tenants->uuid($uuid)->first();
		$scope 		= $this->data->scopes->where('tenant_id', $tenant->id)->get()->delete();

		$tenant->delete();
		DB::commit();

		//////////////
		// Retrieve //
		//////////////

		////////////
		// Return //
		////////////
	}

	/**
	* Untuk menambah scope di tenant tertentu
	*
	* @param String $scope scope dari tenant tertentu  
	* @param String $tenant_uuid 
	* @param Carbon $at 
	*
	*/
	public function add_scope(String $scope, String $tenant_uuid, Carbon $at = null)
	{
		//////////////
		// Policies //
		//////////////

		////////
		// Do //
		////////
		DB::beginTransaction();
		$tenant 	= $this->data->tenants->uuid($tenant_uuid)->first();
		$this->data->scopes()->create(['scope' => $scope, 'tenant_id' => $tenant->id, 'tanggal_kadaluarsa' => $at]);
		DB::commit();

		//////////////
		// Retrieve //
		//////////////

		////////////
		// Return //
		////////////
	}

	/**
	* Untuk menghapus scope dan owner
	*
	* @param String $scope scope dari tenant tertentu  
	*
	*/
	public function remove_scope(String $scope, String $tenant_uuid = null)
	{
		//////////////
		// Policies //
		//////////////

		////////
		// Do //
		////////
		DB::beginTransaction();

		$scope 		= $this->data->scopes->where('scope', $scope);
		
		if(!is_null($tenant_uuid)){
			$tenant	= $this->data->tenants->uuid($tenant_uuid)->first();
			$scope 	= $scope->where('tenant_id', $tenant->id);
		}
		
		$scope->get()->delete();

		DB::commit();

		//////////////
		// Retrieve //
		//////////////

		////////////
		// Return //
		////////////
	}
}