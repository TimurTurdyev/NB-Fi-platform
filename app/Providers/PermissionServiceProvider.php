<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\Dashboard;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Dashboard $dashboard)
    {
        $permissions = ItemPermission::group('Main')
            ->addPermission('analytics', 'Access to data analytics')
            ->addPermission('monitor', 'Access to the system monitor');

        $dashboard->registerPermissions($permissions);
    }
}
