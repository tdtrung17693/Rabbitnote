<?php

use Symfony\Component\HttpFoundation\Response as HttpResponse;

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


Route::group(['middleware' => 'web'], function () {
    Route::auth();



    Route::get('/', 'HomeController@index');

    Route::get('/app', ['as' => 'notes.app', 'uses' => 'NotesController@index']);

    Route::get('home', function () {
        if (\Auth::check()) {
            return redirect()->route('notes.app');
        }

        return redirect('/login');
    });
});

Route::post('/signin', function () {
    $credentials = Request::only('email', 'password');

    if (! $token = JWTAuth::attempt($credentials)) {
        return Response::json(false, HttpResponse::HTTP_UNAUTHORIZED);
    }

    return Response::json(compact('token'));
});

Route::group(['prefix' => 'api', 'middleware' => ['api', 'jwt.auth']], function () {
    Route::resource('notes', 'Api\NotesController');
});
