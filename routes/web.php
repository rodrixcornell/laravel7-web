<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

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
})->name('root');

Route::get('/locale', function () {
	$locale = session('locale');
	$locale = ($locale !== 'en') ? 'en' : 'pt_br';
	// $locale = App::getLocale();
	// if (App::isLocale('pt_br')) {
	session(['locale' => $locale]);
	App::setLocale($locale);

	return redirect()->back();
})->name('locale');

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::group([
	'prefix' => 'admin',
	'as' => 'admin.',
	'namespace' => 'Admin',
	'middleware' => 'auth',
], function () {
	Route::resource('users', 'UserController');
	Route::resource('roles', 'RoleController');
	Route::resource('permissions', 'PermissionController');
});
