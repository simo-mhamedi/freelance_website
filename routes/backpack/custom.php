<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('user', 'UserCrudController');
    Route::crud('estimate', 'EstimateCrudController');
    Route::crud('user-categorie', 'UserCategorieCrudController');
    Route::crud('categorie', 'CategorieCrudController');
    Route::crud('sub-categorie', 'SubCategorieCrudController');
    Route::crud('request', 'RequestCrudController');
    Route::get('charts/weekly-users', 'Charts\WeeklyUsersChartController@response')->name('charts.weekly-users.index');
    Route::crud('membership', 'MembershipCrudController');
    Route::crud('user-membership', 'UserMembershipCrudController');
});