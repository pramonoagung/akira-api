<?php

namespace Thunderlabid\Reservasi;

use Illuminate\Support\ServiceProvider;

class ReservasiServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application events.
	 */
	public function boot()
	{
		$this->loadMigrationsFrom(__DIR__.'/Migrations');
    }
    
}
