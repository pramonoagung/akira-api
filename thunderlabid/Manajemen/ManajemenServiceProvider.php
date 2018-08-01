<?php

namespace Thunderlabid\Manajemen;

use Illuminate\Support\ServiceProvider;

class ManajemenServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application events.
	 */
	public function boot()
	{
		$this->loadMigrationsFrom(__DIR__.'/Migrations');
    }
    
}
