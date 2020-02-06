<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*Get Routes*/




Auth::routes();
//Route::get('/', 'MediaController@index');
Route::get('/media','MediaController@index');
Route::get('/media/sample','MediaController@sample');
Route::get('/media/getimages','MediaController@getimages');
Route::get('/media/delete/{media_id}','MediaController@delete');
/*Post Routes*/
Route::post('/media/uploadimages', 'MediaController@uploadimages');



Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
});