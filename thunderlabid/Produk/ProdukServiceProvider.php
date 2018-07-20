<?php

namespace Thunderlabid\Produk;

use Illuminate\Support\ServiceProvider;

class ProdukServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application events.
	 */
	public function boot()
	{
		$this->loadMigrationsFrom(__DIR__.'/Migrations');
    }
    
}
