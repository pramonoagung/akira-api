<?php

namespace App\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\CheckVoucherEvent' => [
            'App\Listeners\CheckVoucherListener',
        ],
		 'App\Events\CekTerapisEvent' => [
            'App\Listeners\CekTerapisListener',
        ],
		 'App\Events\CekProdukEvent' => [
            'App\Listeners\CekProdukListener',
        ],
         'App\Events\AddLogKepemilikanEvent' => [
            'App\Listeners\AddLogKepemilikanListener',
        ],
         'App\Events\SendNotification' => [
            'App\Listeners\SendNotificationListener',
        ],
    ];
}
