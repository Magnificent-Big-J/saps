<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('circulation','CirculationController');
Route::resource('entry','EntryController');
Route::get('validCheck/{id}','EntryController@validCheck');
Route::get('reports','ReportsController@index');
Route::get('test','ReportsController@test');