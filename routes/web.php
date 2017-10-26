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

Route::view('/', 'welcome');

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
Route::get('/profile/{id}/user', 'ProfileController@password_reset')->name('user.reset.password')->middleware(['role:admin']);
Route::patch('/profile/user/{id}', 'ProfileController@passwordReset')->name('resets.password')->middleware(['role:admin']);

//students routes o-level
Route::get('/students/my-profile/{id}', 'StudentController@my_profile')->name('students.my_profile');
Route::get('/students/o-level', 'StudentController@o_index')->name('students.o-level')->middleware(['role:admin']);
Route::get('/students/o-level/create', 'StudentController@o_create')->name('olevel.create')->middleware(['role:admin']);
Route::post('/students/o-level', 'StudentController@o_store')->name('olevel.store')->middleware(['role:admin']);
Route::get('/students/o-level/{id}/show', 'StudentController@o_show')->name('olevel.show')->middleware(['role:admin']);
Route::get('/students/o-level/{id}/edit', 'StudentController@o_edit')->name('olevel.edit')->middleware(['role:admin']);
Route::patch('/students/o-level/{id}/{userId}', 'StudentController@o_update')->name('olevel.update')->middleware(['role:admin']);
Route::delete('/students/o-level/{id}', 'StudentController@destroy')->name('olevel.destroy')->middleware(['role:admin']);
Route::get('/students/password/{id}/reset', 'StudentController@password_reset')->name('password.reset')->middleware(['role:admin']);
Route::patch('/students/reset/{id}/{userId}', 'StudentController@passwordReset')->name('reset.password')->middleware(['role:admin']);
Route::patch('/students/profile/{id}', 'StudentController@profileImage')->name('students.profile')->middleware(['role:admin']);

//students routes a-level
Route::get('/students/a-level', 'StudentController@a_index')->name('students.a-level')->middleware(['role:admin']);

//staff routes
Route::get('/staff/teachers', 'TeacherController@index')->name('teachers.index')->middleware(['role:admin']);
Route::get('/staff/teachers/create', 'TeacherController@create')->name('teachers.create')->middleware(['role:admin']);
Route::post('/staff/teachers', 'TeacherController@store')->name('teachers.store')->middleware(['role:admin']);
Route::get('/staff/teachers/{id}/show', 'TeacherController@show')->name('teachers.show')->middleware(['role:admin']);
Route::get('/staff/teachers/{id}/edit', 'TeacherController@edit')->name('teachers.edit')->middleware(['role:admin']);
Route::patch('/staff/teachers/{id}/{userId}', 'TeacherController@update')->name('teachers.update')->middleware(['role:admin']);
Route::delete('/staff/teachers/{id}', 'TeacherController@destroy')->name('teachers.destroy')->middleware(['role:admin']);

Route::get('/staff/teachers/{id}/subjects', 'TeacherController@subjects')->name('teachers.subjects')->middleware(['role:admin']);
Route::get('/staff/teachers/{id}/add/subjects', 'TeacherController@addSubjects')->name('teachers.addsubjects')->middleware(['role:admin']);
Route::post('/staff/teachers/add/subject/{id}', 'TeacherController@subjectsAdd')->name('addteachers.subjects')->middleware(['role:admin']);
Route::delete('/staff/teachers/subject/{id}', 'TeacherController@subjectDestroy')->name('teachersub.destroy')->middleware(['role:admin']);
Route::get('/staff/teachers/{id}/classes', 'TeacherController@classTeacher')->name('classteacher.index')->middleware(['role:admin']);
Route::post('/staff/teachers/classes/{id}', 'TeacherController@assignClass')->name('classteacher.store')->middleware(['role:admin']);
Route::delete('/staff/teachers/classes/{id}/destroy', 'TeacherController@classTeacherDestroy')->name('classteacher.destroy')->middleware(['role:admin']);

Route::get('/assessment/teacher/{id}/index', 'AssessmentController@index')->name('teacher.assessment')->middleware(['role:teacher']);
Route::get('/assessment/teacher/{id}/add', 'AssessmentController@create')->name('teacher.createassessment');
Route::get('/assessment/teacher/class/{class_id}/student/{id}/add', 'AssessmentController@add')->name('teacher.addassessment');
Route::post('/assessment/teacher/class/{class_id}/student/{id}/store', 'AssessmentController@store')->name('teacher.storeassessment');
Route::post('/assessment/teacher/class/{class_id}', 'AssessmentController@set')->name('teacher.setassessment');
Route::get('/assessment/teacher/student/{student_id}/{class_id}/class', 'AssessmentController@edit')->name('teacher.editassessment');
Route::patch('/assessment/teacher/student/{student_id}/{class_id}/class', 'AssessmentController@update')->name('teacher.updateassessment');
//api routes
Route::get('/api/teachers/subjects/{id}', 'TeacherController@getSubjects')->middleware(['role:admin']);