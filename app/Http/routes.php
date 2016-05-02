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


Route::group(['middleware' => ['web']], function () {
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

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['middleware' => ['api.throttle', 'cors'], 'limit' => 100, 'expires' => 5], function ($api) {
    $api->post('auth', function () {
        $credentials = Request::only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Bad credentials'], HttpResponse::HTTP_UNAUTHORIZED);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could not create token'], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json(compact('token'));
    });

    $api->delete('auth', ['middleware' => 'api.auth', 'uses' => 'App\Http\Controllers\Api\UsersController@logout']);

    $api->get('/', function () {
        return response()->json('Rabbitnote API');
    });

    $api->group(['prefix' => 'users/{user}', 'namespace' => '\App\Http\Controllers\Api'], function ($api) {
        $api->resource('notes', 'NotesController');
    });

    $api->get('user', '\App\Http\Controllers\Api\UsersController@index');
});