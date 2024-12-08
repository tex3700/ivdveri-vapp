<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Konekt\Acl\Contracts\Permission as PermissionContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        if (Str::startsWith(config('app.url'), 'https://')) {
            URL::forceScheme('https');
        }

        $this->app->concord->registerModel(\Konekt\User\Contracts\User::class, \App\Models\User::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->concord->registerModel(PermissionContract::class, \App\Models\Permission::class);
    }
}
