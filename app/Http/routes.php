<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/client','ClientController@index');
Route::get('/client/{id}','ClientController@show');
Route::delete('/client/{id}','ClientController@destroy');
Route::post('/client','ClientController@store');
Route::put('/client/{id}','ClientController@update');

Route::get('/project/{id}/note','ProjectNoteController@index');
Route::get('/project/{id}/note/{noteId}','ProjectNoteController@show');
Route::post('/project/{id}/note','ProjectNoteController@store');
Route::put('/project/{id}/note/{noteId}','ProjectNoteController@update');
Route::delete('/project/{id}/note/{noteId}','ProjectNoteController@destroy');


Route::get('/project/{id}/task','ProjectTaskController@index');
Route::get('/project/{id}/task/{taskId}','ProjectTaskController@show');
Route::post('/project/{id}/task','ProjectTaskController@store');
Route::put('/project/{id}/task/{taskId}','ProjectTaskController@update');
Route::delete('/project/{id}/task/{taskId}','ProjectTaskController@destroy');

Route::get('/project/{id}/members','ProjectController@members');
Route::get('/project/{id}/members/{memberId}','ProjectController@member');
Route::post('/project/{id}/members/{memberId}','ProjectController@addMember');
Route::delete('/project/{id}/members/{memberId}','ProjectController@removeMember');

Route::get('/project','ProjectController@index');
Route::get('/project/{id}','ProjectController@show');
Route::post('/project','ProjectController@store');
Route::put('/project/{id}','ProjectController@update');
Route::delete('/project/{id}','ProjectController@destroy');


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
