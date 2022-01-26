<?php

declare(strict_types=1);

use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Example...
require_once 'examples.php';

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Profile'), route('platform.profile'));
    });

// Platform > System > Users
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(function (Trail $trail, $user) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('User'), route('platform.systems.users.edit', $user));
    });

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('Create'), route('platform.systems.users.create'));
    });

// Platform > System > Users > User
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Users'), route('platform.systems.users'));
    });

// Platform > System > Roles > Role
Route::screen('roles/{roles}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(function (Trail $trail, $role) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Role'), route('platform.systems.roles.edit', $role));
    });

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Create'), route('platform.systems.roles.create'));
    });

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Roles'), route('platform.systems.roles'));
    });

// Main Route

// Platform > System > Companies > Edit
Route::screen('companies/{company}/edit', \App\Orchid\Screens\Company\CompanyEditScreen::class)
    ->name('platform.systems.companies.edit')
    ->breadcrumbs(function (Trail $trail, $company) {
        return $trail
            ->parent('platform.systems.companies')
            ->push(__('Company'), route('platform.systems.companies.edit', $company));
    });

// Platform > System > Companies > Create
Route::screen('companies/create', \App\Orchid\Screens\Company\CompanyEditScreen::class)
    ->name('platform.systems.companies.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.companies')
            ->push(__('Create'), route('platform.systems.companies.create'));
    });

// Platform > System > Companies > List
Route::screen('companies', \App\Orchid\Screens\Company\CompanyListScreen::class)
    ->name('platform.systems.companies')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Companies'), route('platform.systems.companies'));
    });

// Platform > System > Buildings > Edit
Route::screen('buildings/{building}/edit', \App\Orchid\Screens\Building\BuildingEditScreen::class)
    ->name('platform.systems.buildings.edit')
    ->breadcrumbs(function (Trail $trail, $building) {
        return $trail
            ->parent('platform.systems.buildings')
            ->push(__('Building'), route('platform.systems.buildings.edit', $building));
    });

// Platform > System > Buildings > Create
Route::screen('buildings/create', \App\Orchid\Screens\Building\BuildingEditScreen::class)
    ->name('platform.systems.buildings.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.buildings')
            ->push(__('Create'), route('platform.systems.buildings.create'));
    });

// Platform > System > Buildings > List
Route::screen('buildings', \App\Orchid\Screens\Building\BuildingListScreen::class)
    ->name('platform.systems.buildings')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Buildings'), route('platform.systems.buildings'));
    });

// Platform > System > Places > Edit
Route::screen('places/{place}/edit', \App\Orchid\Screens\Place\PlaceEditScreen::class)
    ->name('platform.systems.places.edit')
    ->breadcrumbs(function (Trail $trail, $place) {
        return $trail
            ->parent('platform.systems.places')
            ->push(__('Place'), route('platform.systems.places.edit', $place));
    });

// Platform > System > Places > Create
Route::screen('places/create', \App\Orchid\Screens\Place\PlaceEditScreen::class)
    ->name('platform.systems.places.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.places')
            ->push(__('Create'), route('platform.systems.places.create'));
    });

// Platform > System > Places > List
Route::screen('places', \App\Orchid\Screens\Place\PlaceListScreen::class)
    ->name('platform.systems.places')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Places'), route('platform.systems.places'));
    });
