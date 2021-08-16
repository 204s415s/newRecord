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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/*
|-----------------------
|   api取得のためのURL
|-----------------------
*/
Route::get('/api/users', 'UserController@index');
Route::get('/api/students', 'StudentController@index');
Route::get('/api/students/clear', 'StudentController@clear');
Route::get('/api/students/enter', 'StudentController@enter');
Route::get('/api/students/label', 'StudentController@label');
Route::get('/api/students/table', 'StudentController@table');
Route::post('/api/students', 'StudentController@store');
Route::get('/api/students/{student}', 'StudentController@show');
Route::get('/api/students/{student}/record', 'StudentController@record');
Route::get('/api/students/{student}/level', 'StudentController@level');
Route::put('/api/students/{student}', 'StudentController@update');
Route::delete('/api/students/{student}', 'StudentController@destroy');

Route::get('/api/mypage/student', 'MypageController@student');
Route::get('/api/mypage/calendar', 'MypageController@calendar');
Route::get('/api/mypage/today', 'MypageController@today');

Route::get('/api/record/curriculum', 'CurriculumController@index');
Route::post('/api/record/curriculum', 'CurriculumController@store');

Route::get('/api/record/project', 'ProjectController@index');
Route::post('/api/record/project', 'ProjectController@store');

Route::get('/api/{enter}', 'StudentController@select');


/*
|-----------------------
|   すべてのルートでapp.blade.phpを表示する
|   未ログインユーザーはログイン画面にリダイレクトする
|-----------------------
*/
Route::group(['middleware' => ['auth']], function() {
    Route::get('/{any}', function() {
    return view('app');
    })->where('any', '.*');
});