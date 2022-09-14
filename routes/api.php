<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:api')->get('login', function (Request $request) {
    return "LoginTest";
}); */

Route::post('login', [App\Http\Controllers\Api\Auth\LoginController::class, 'store']);

Route::group(['middleware' =>  'auth.key:api'], function () {
    Route::group(['prefix' => ''], function () {
        Route::get('profile', App\Http\Controllers\Api\Auth\ProfilesController::class . '@index');
        Route::post('logout', App\Http\Controllers\Api\Auth\LogoutController::class . '@store');

        // Route::apiResource('company', App\Http\Controllers\Api\CompanyController::class);
    });
});

Route::group(['middleware' => [
    'auth.key:api', 'role:SuperAdmin|Admin'
]], function () {
    Route::apiResource('group', App\Http\Controllers\Api\GroupController::class);
    Route::apiResource('company', App\Http\Controllers\Api\CompanyController::class);
    Route::apiResource('contact', App\Http\Controllers\Api\ContactController::class);
});





/* Route::apiResources([
    'photos' => PhotoController::class,
    'posts' => PostController::class,
]); */
