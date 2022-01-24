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
        $permissions = ItemPermission::group('Companies')
            ->addPermission('companies.list', 'Access to companies')
            ->addPermission('companies.create', 'Access to the company create')
            ->addPermission('companies.edit', 'Access to the company edit');

        $dashboard->registerPermissions($permissions);
    }
}
