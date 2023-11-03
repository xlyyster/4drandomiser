<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\MathController@home')->name('home');
Route::post('/calculate', 'App\Http\Controllers\MathController@calculate')->name('calculate');
Route::get('/result', 'App\Http\Controllers\MathController@result')->name('result');
Route::get('/latest-data', 'App\Http\Controllers\MathController@latestData');
Route::get('/numpad', 'App\Http\Controllers\NumpadController@index');
Route::post('/numpad', 'App\Http\Controllers\NumpadController@submit');
Route::get('/previous_data', 'App\Http\Controllers\PreviousDataController@index')->name('previous_data');
