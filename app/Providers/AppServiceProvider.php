<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Laravel\Horizon\Horizon;
use App\Card\Cart;

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
    	$this->app->singleton(Cart::class, function ($app) {
    		return new Cart($app->auth->user());
		});
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
        DB::listen(function ($query) {
        	Log::info($query->sql);
//        	Log::info($query->sql . ' [' . implode(', ', $query->bindings) . ']');
		});
    }
}
