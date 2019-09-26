<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Horizon\Horizon;

//use Laravel\Horizon\Horizon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        if ($this->app->environment() !== 'production') {
//            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
//            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
//        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Horizon::auth(function ($request) {
            return true;
        });
    }
}
