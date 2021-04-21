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

Route::group(['middleware' => 'auth'],
    function () {
        Route::resource('projects', 'ProjectsController');
        Route::post('/projects/{project}/invitations', 'ProjectInvitationsController@store');

        Route::post('/projects/{project}/tasks', 'ProjectTasksConroller@store');
        Route::patch('/projects/{project}/tasks/{task}', 'ProjectTasksConroller@update');

        Route::post('/projects', 'ProjectsController@store');
        Route::get('/home', 'HomeController@index')->name('home');
    });

Auth::routes();

Route::get('/chatroom', 'ChatsController@index');
Route::get('messages', 'ChatsController@fetchMessages');
Route::post('messages', 'ChatsController@sendMessage');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
