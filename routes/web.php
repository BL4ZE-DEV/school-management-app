<?php

use Illuminate\Support\Facades\Route;


// Route::domain('{tenant}.'.config('app.domain'))
//     ->middleware('tenant')
//     ->group(function () {
//         require base_path('routes/tenant.php');
//     });

// Route::get('/', function () {
//     // return view('welcome');
//     // dd(config('app.domain'));
//     return "This is the main application home page.";
// });


use App\Http\Controllers\Tenant\Web\AuthController;
use App\Http\Controllers\Tenant\Web\DashboardController;

Route::domain('{tenant}.' . config('app.domain'))
        ->middleware(['tenant'])
        ->group(function () {

    Route::middleware('guest:tenant_web')
        ->group(function () {

            Route::get(
                '/login',
                [AuthController::class, 'create']
            )->name('tenant.login');

            Route::post(
                '/login',
                [AuthController::class, 'store']
            );
        });

    Route::middleware('auth:tenant_web')
        ->group(function () {

            Route::get(
                '/dashboard',
                [DashboardController::class, 'index']
            )->name('tenant.dashboard');

            Route::post(
                '/logout',
                [AuthController::class, 'destroy']
            )->name('tenant.logout');

        });
});