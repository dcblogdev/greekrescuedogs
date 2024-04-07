<?php

namespace Modules\Dogs\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function map(): void
    {
        Route::middleware('web')
           ->group(base_path('Modules/Dogs/routes/web.php'));
    }
}
