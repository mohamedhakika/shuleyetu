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
Route::view('dashboard', 'index');
Route::view('/loginpage', 'auth/loginpage');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Setting routes
Route::get('/setting/classes', 'SettingsController@getclass')->name('setting.classes')->middleware(['role:admin']);
Route::post('/setting/classes', 'SettingsController@setclass')->name('setting.classes')->middleware(['role:admin']);