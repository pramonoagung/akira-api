<?php

namespace Thunderlabid\Otorisasi;

///////////////
// Framework //
///////////////
use Illuminate\Support\ServiceProvider;

///////////////
// Observers //
///////////////
use Thunderlabid\Otorisasi\Models\Observers\GenerateUUID;
use Thunderlabid\Otorisasi\Models\Observers\Validate;

class OtorisasiServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application events.
	 */
	public function boot()
	{
		////////////////
		// Migrations //
		////////////////
		$this->loadMigrationsFrom(__DIR__.'/Migrations');

		////////////////////
		// Event Listener //
		////////////////////
		Models\Tenant::observe(new GenerateUUID);
		Models\User::observe(new Validate);
	}

	/**
	 * Register the service provider.
	 */
	public function register()
	{
		config()->set('otorisasi.owner.default', 'admin');
	}
}
