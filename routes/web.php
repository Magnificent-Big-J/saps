<?php


Route::get('/','FrontEndController@about')->name('about.us');
Route::get('/contact','FrontEndController@contact')->name('contact.us');
Auth::routes();

Route::get('/dashboard','HomeController@index')->name('dashboard');
Route::get('/image','testController@index')->name('image');
//Route::get('/test','testController@test')->name('test');
Route::post('/store','testController@store');
Route::post('/saveImage','testController@saveImage');
Route::resource('circulation','CirculationController');
Route::group(['middleware'=>'auth'],function (){
    Route::get('/dashboard','EntryController@create')->name('dashboard');
    Route::get('/circulations','CirculationController@create')->name('circulations');
    Route::get('/reports','ReportsController@create')->name('reports');
    Route::post('/saveImage/{id}','EntryController@saveImage');
    Route::post('/saveImages/{id}','CirculationController@saveImage');
});
