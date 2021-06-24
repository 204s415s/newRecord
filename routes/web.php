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

/*
Route::get('/', function () {
    return view('welcome');
});*/

// Route::get('/', 'RecordController@top');

// Route::get('/students/index', 'StudentController@index');
// Route::get('/students/create', 'StudentController@create');
// Route::get('/students/{student}', 'StudentController@show');
// Route::post('/students', 'StudentController@store');

// Route::get('/vuetest', 'CurriculumController@test');

// Route::get('/curricula/record', 'CurriculumController@record');
// Route::get('/fetch/curricula', 'CurriculumController@fetch');
// Route::post('/curricula', 'CurriculumController@store');

// Route::get('/projects/record', 'ProjectController@record');
// Route::post('/projects', 'ProjectController@store');


Route::get('/{any}', function() {
    return view('app');
})->where('any', '.*');

//Route::get('/google', 'UserController@google');

//Route::get('/students/index', 'StudentController@index');
//Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
