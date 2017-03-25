<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('oauth/access_token', function(){
   return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware'=>'oauth'], function(){

    Route::resource('cliente', 'ClienteController', ['except'=>['create', 'edit']]);

    Route::group(['middleware'=> 'check-project-perms'], function() {
        Route::resource('project', 'ProjectController', ['except' => ['create', 'edit']]);

        Route::Group(['prefix'=>'project'], function(){
            Route::get('{id}/notes', 'ProjectNoteController@index');
            Route::post('{id}/notes', 'ProjectNoteController@store');
            Route::get('{id}/notes/{noteId}', 'ProjectNoteController@show');
            Route::put('{id}/notes/{noteId}', 'ProjectNoteController@update');
            Route::delete('{id}/notes/{noteId}', 'ProjectNoteController@destroy');

            Route::get('{id}/tasks', 'ProjectTaskController@index');
            Route::post('{id}/tasks', 'ProjectTaskController@store');
            Route::get('{id}/tasks/{taskId}', 'ProjectTaskController@show');
            Route::put('{id}/tasks/{taskId}', 'ProjectTaskController@update');
            Route::delete('{id}/tasks/{taskId}', 'ProjectTaskController@destroy');

            Route::post('{id}/file', 'ProjectFileController@store');

            Route::post('{id}/members', 'ProjectMemberController@index');
        });
    });
});

