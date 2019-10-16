<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\JobsObserver;
use App\Models\Jobs;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Jobs::observe(JobsObserver::class);
        \DB::listen(function($sql) {
//            Log::info(json_encode($sql, JSON_PRETTY_PRINT));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
//        \DB::listen(
//            function ($query) {
//                Log::debug($query->sql);
//                Log::debug(json_encode($query->bindings, JSON_PRETTY_PRINT));
//                Log::debug($query->time);
//            }
//        );
    }
}
