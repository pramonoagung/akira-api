<?php

namespace Thunderlabid\Pembayaran;

use Illuminate\Support\ServiceProvider;

class PembayaranServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application events.
	 */
	public function boot()
	{
		$this->loadMigrationsFrom(__DIR__.'/Migrations');
    }
    
}
