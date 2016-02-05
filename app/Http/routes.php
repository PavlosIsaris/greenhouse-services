<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return 'Hello World';
});

Route::get('humidity/set', [
    'uses' => 'DataController@setData'
]);

Route::get('temperature/set', [
    'uses' => 'DataController@setTemperature'
]);

Route::get('humidity/get', [
    'uses' => 'DataController@getHumidities'
]);

Route::get('temperature/get', [
    'uses' => 'DataController@getTemperatures'
]);

Route::get('methane/get', [
    'uses' => 'DataController@getMethane'
]);