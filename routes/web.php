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
        ->name('auth.registerWorker')->middleware(['auth:web', 'permission:register-worker']);
    Route::post('/register', 'Auth\AuthController@register')
        ->name('auth.register')->middleware(['auth:web', 'permission:register-worker']);
    Route::post('/login', 'Auth\AuthController@login')
        ->name('auth.login');
    Route::get('/logout', 'Auth\AuthController@logout')
        ->name('auth.logout')->middleware('auth:web');
});

Route::group(['prefix' => 'profile', 'namespace' => 'App\Http\Controllers', 'middleware' => ['auth:web']], static function () {
    Route::get('/', 'Profile\ProfileController@index')
        ->name('profile.index');
});

Route::group(['prefix' => 'collect', 'namespace' => 'App\Http\Controllers', 'middleware' => ['auth:web', 'permission:store-measure']], static function () {
    Route::get('/', 'Collect\CollectController@index')
        ->name('collect.index');
});

Route::group(['prefix' => 'measures', 'namespace' => 'App\Http\Controllers', 'middleware' => ['auth:web', 'permission:view-measure|edit-measure']], static function () {
    Route::get('/', 'Measure\MeasureController@index')
        ->name('measures.index');
});

Route::group(['prefix' => 'reports', 'namespace' => 'App\Http\Controllers', 'middleware' => ['auth:web', 'permission:view-reports']], static function () {
    Route::get('/', 'Report\ReportController@index')
        ->name('reports.index');
});

