<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\ACL\Permissao;
use App\Observers\ACL\PermissaoObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Permissao::observe(PermissaoObserver::class);
    }
}
