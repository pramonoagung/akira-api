<?php

namespace Thunderlabid\Voucher;

use Illuminate\Support\ServiceProvider;

class VoucherServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application events.
	 */
	public function boot()
	{
		$this->loadMigrationsFrom(__DIR__.'/Migrations');
    }
    
}
