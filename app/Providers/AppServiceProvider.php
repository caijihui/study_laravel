<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\JobsObserver;
use App\Models\Jobs;

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
