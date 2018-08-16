<?php

namespace Thunderlabid\About;

use Illuminate\Support\ServiceProvider;

class AboutServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application events.
	 */
	public function boot()
	{
		$this->loadMigrationsFrom(__DIR__.'/Migrations');
    }
    
}
