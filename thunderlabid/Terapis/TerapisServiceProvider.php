<?php

namespace Thunderlabid\Terapis;

use Illuminate\Support\ServiceProvider;

class TerapisServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application events.
	 */
	public function boot()
	{
		$this->loadMigrationsFrom(__DIR__.'/Migrations');
    }
    
}
