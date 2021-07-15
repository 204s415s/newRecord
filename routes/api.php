<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middeleware' => 'api'], function() {
    Route::get('/users', 'UserController@index');
    Route::get('/students', 'StudentController@index');
    Route::get('/students/clear', 'StudentController@clear');
    Route::get('/students/enter', 'StudentController@enter');
    Route::post('/students', 'StudentController@store');
    Route::get('/students/{student}', 'StudentController@show');
    Route::get('/students/{student}/record', 'StudentController@record');
    Route::get('/students/{student}/level', 'StudentController@level');
    Route::put('/students/{student}', 'StudentController@update');
    Route::delete('/students/{student}', 'StudentController@destroy');
    
    Route::get('/mypage/student', 'MypageController@student');
    Route::get('/mypage/calendar', 'MypageController@calendar');
    
    Route::get('/record/curriculum', 'CurriculumController@index');
    Route::post('/record/curriculum', 'CurriculumController@store');
    
    Route::get('/record/project', 'ProjectController@index');
    Route::post('/record/project', 'ProjectController@store');
    
    Route::get('/{enter}', 'StudentController@select');
});

