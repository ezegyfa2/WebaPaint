<?php

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

Route::prefix('users')->group(function() {
    Route::post('login', 'LoginController@login');
});
Route::middleware('auth:api')->group(function() {
    Route::prefix('shapes')->group(function() {
        Route::get('/', 'ShapeController@index');
        Route::get('/{id}', 'ShapeController@getShape');
        Route::post('rectangles/create', 'ShapeController@createRectangle');
        Route::post('circles/create', 'ShapeController@createCircle');
    });
    Route::prefix('paints')->group(function() {
        Route::get('/', 'PaintController@index');
        Route::get('/{id}', 'PaintController@getPaint');
        Route::post('create', 'PaintController@create');
    });
});
