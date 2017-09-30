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

Route::get('/setting/subjects', 'SubjectController@index')->name('setting.subjects')->middleware(['role:admin']);
Route::get('/setting/subjects/create', 'SubjectController@create')->name('subjects.create')->middleware(['role:admin']);
Route::post('/setting/subjects', 'SubjectController@store')->name('setting.subjects')->middleware(['role:admin']);
Route::get('/setting/subjects/{id}/edit', 'SubjectController@edit')->name('subjects.edit')->middleware(['role:admin']);
Route::patch('/setting/subjects/{id}', 'SubjectController@update')->name('subjects.update')->middleware(['role:admin']);
Route::delete('/setting/subjects/{id}', 'SubjectController@destroy')->name('subjects.destroy')->middleware(['role:admin']);

Route::view('/profile/user', 'profile.index')->name('profile.user')->middleware('auth');
Route::patch('/profile/{id}', 'ProfileController@update')->name('profile.password');

//students routes o-level
Route::get('/students/o-level', 'StudentController@o_index')->name('students.o-level')->middleware(['role:admin']);
Route::get('/students/o-level/create', 'StudentController@o_create')->name('olevel.create')->middleware(['role:admin']);
Route::post('/students/o-level', 'StudentController@o_store')->name('olevel.store')->middleware(['role:admin']);
Route::get('/students/o-level/{id}/show', 'StudentController@o_show')->name('olevel.show')->middleware(['role:admin']);
Route::get('/students/o-level/{id}/edit', 'StudentController@o_edit')->name('olevel.edit')->middleware(['role:admin']);
Route::patch('/students/o-level/{id}/{userId}', 'StudentController@o_update')->name('olevel.update')->middleware(['role:admin']);
Route::delete('/students/o-level', 'StudentController@o_destroy')->name('olevel.destroy')->middleware(['role:admin']);
Route::get('/students/password/{id}/reset', 'StudentController@password_reset')->name('password.reset')->middleware(['role:admin']);
Route::patch('/students/reset/{id}/{userId}', 'StudentController@passwordReset')->name('reset.password')->middleware(['role:admin']);
Route::patch('/students/profile/{id}', 'StudentController@profileImage')->name('students.profile')->middleware(['role:admin']);

//students routes a-level
Route::get('/students/a-level', 'StudentController@a_index')->name('students.a-level')->middleware(['role:admin']);