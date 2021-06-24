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
    Route::post('login', 'AuthController@login')->name('login');;
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');
    
    Route::get('/users', 'UserController@index');
    Route::get('/grades', 'StudentController@grade');
    Route::get('/students', 'StudentController@index');
    Route::post('/students', 'StudentController@store');
    Route::get('/students/{student}', 'StudentController@show');
    Route::put('/students/{student}', 'StudentController@update');
    Route::delete('/students/{student}', 'StudentController@destroy');
});

