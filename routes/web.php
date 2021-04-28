<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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
    return view('auth.login');
})->name('login');



Route::middleware(['auth'])->group(function () {

	Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
	Route::post('/saveProjectSetup', 'App\Http\Controllers\DashboardController@saveProjectSetup')->name('saveProjectSetup');

	Route::post('/deleteProjectItem', 'App\Http\Controllers\DashboardController@deleteProjectItem');
	
	Route::get('/project/{id?}', 'App\Http\Controllers\DashboardController@projectForm')->name('project');
	Route::get('/deadline/{id}', 'App\Http\Controllers\DashboardController@deadlineProject')->name('tracing');

	Route::post('/saveDeadline', 'App\Http\Controllers\DashboardController@saveDeadline');
	Route::get('/deleteDeadline/{id}', 'App\Http\Controllers\DashboardController@deleteDeadline');

	Route::get('/trace/{id}/{view?}', 'App\Http\Controllers\DashboardController@showTrace');
	
	Route::get('/registro', function () {
    	return view('auth.register');
	})->name('registro');
	

});


require __DIR__.'/auth.php';
