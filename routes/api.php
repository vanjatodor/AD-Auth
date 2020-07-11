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
Route::post('/login', 'Auth\LoginController@login');




Route::group(['middleware' => ['auth:api']], function () {

    // Authentication Routes
    Route::post('/logout', 'Auth\LoginController@logout');

    // Example Routes
    Route::get('/admin/load/example1', function () {
        return 'some data';
    });

    Route::get('/admin/load/example2', function () {
        return 'some data';
    });
});