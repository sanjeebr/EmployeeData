<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', ['as' => 'instert','uses' => 'CsvOperationsController@home']);
Route::post('/upload', ['as' => 'upload','uses' => 'CsvOperationsController@upload']);

Route::get('/datatable', ['as' => 'datatable_page','uses' => 'CsvOperationsController@datatable']);
Route::post('/datatable', ['as' => 'datatable','uses' => 'CsvOperationsController@datatableindex']);

Route::get('/graph', ['as' => 'graph','uses' => 'CsvOperationsController@graph']);