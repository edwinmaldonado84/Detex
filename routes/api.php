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

Route::group(['middleware' =>  'auth:api'], function () {
    Route::group(['prefix' => ''], function () {
        Route::get('profile', App\Http\Controllers\Api\Auth\ProfilesController::class . '@index');
        Route::post('logout', App\Http\Controllers\Api\Auth\LogoutController::class . '@store');
    });
});




/* Route::apiResources([
    'photos' => PhotoController::class,
    'posts' => PostController::class,
]); */
