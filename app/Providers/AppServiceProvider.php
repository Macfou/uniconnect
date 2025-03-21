<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

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
        Model::unguard();

        // Register the admin-layout component
        Blade::component('admin.admin_components.admin-layout', 'admin-layout');

        Blade::component('gso.gso_components.gsolayout', 'gso-layout');
       
        Blade::component('ufmo.ufmo_components.ufmolayout', 'ufmo-layout');

        Blade::component('components.officer_layout', 'officer-layout');
    }

    
}
