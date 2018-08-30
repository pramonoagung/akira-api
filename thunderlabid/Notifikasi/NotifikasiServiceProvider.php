<?php

namespace Thunderlabid\Notifikasi;

use Illuminate\Support\ServiceProvider;

class NotifikasiServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application events.
	 */
	public function boot()
	{
		$this->loadMigrationsFrom(__DIR__.'/Migrations');
    }
    
}
