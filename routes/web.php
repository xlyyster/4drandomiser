<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'App\Http\Controllers\MathController@home');

Route::post('/calculate', 'App\Http\Controllers\MathController@calculate');

Route::get('/latest-data', 'App\Http\Controllers\MathController@latestData');

