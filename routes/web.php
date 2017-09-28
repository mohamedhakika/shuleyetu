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
Route::get('/setting/classes', 'SettingsController@getClass')->name('setting.classes')->middleware(['role:admin']);
Route::post('/setting/classes', 'SettingsController@setClass')->name('setting.classes')->middleware(['role:admin']);
Route::delete('/setting/classes/{id}', 'SettingsController@destroyClass')->name('classes.destroy')->middleware(['role:admin']);
Route::get('/setting/assessment', 'TabiaController@index')->name('setting.assessment')->middleware(['role:admin']);
Route::post('/setting/assessment', 'TabiaController@store')->name('setting.assessment')->middleware(['role:admin']);
Route::get('/setting/assessment/{id}/edit', 'TabiaController@edit')->name('assessment.edit')->middleware(['role:admin']);
Route::patch('/setting/assessment/{id}', 'TabiaController@update')->name('assessment.update')->middleware(['role:admin']);
Route::delete('/setting/assessment/{id}', 'TabiaController@destroy')->name('assessment.destroy')->middleware(['role:admin']);