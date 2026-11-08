<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::domain('{tenant}.' . config('app.domain'))
    ->middleware('tenant')
    ->group(function () {
        require base_path('routes/tenant.php');
    });

Route::post('/register', [App\Http\Controllers\UserController::class, 'register']);
Route::post('/login', [App\Http\Controllers\UserController::class, 'login']);

Route::middleware('auth:api')->group(function (){
   Route::post('/tenant',[App\Http\Controllers\TenantController::class, 'store']); // create tenat
});



