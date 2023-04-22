<?php

use Illuminate\Support\Facades\Route;

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

})->name('welcome')->middleware('auth:web');

Route::group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers'], static function () {
    Route::get('/login', 'Auth\AuthController@index')
        ->name('auth.index');
    Route::get('/register', 'Auth\AuthController@registerWorker')
        ->name('auth.registerWorker');
    Route::post('/register', 'Auth\AuthController@register')
        ->name('auth.register');
    Route::post('/login', 'Auth\AuthController@login')
        ->name('auth.login');
    Route::get('/logout', 'Auth\AuthController@logout')
        ->name('auth.logout')->middleware('auth:web');
});

