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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/newPage', 'HomeController@index2')->name('another');

Route::get('/sendCounter', 'HomeController@sendC')->name('counter');

Route::get('/sendToSpecific/{id}', 'HomeController@sendS')->name('sendSpecific');

Route::get('/getUserId', function() {
    return Auth::user()->toJson();
});