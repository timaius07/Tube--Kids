<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\facades\schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //solucion al error 1071 sql
        schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
