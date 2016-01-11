<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

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


Route::get('/', function () {
    return view('welcome');
});

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

    Route::post('login', function() {
        $credentials = Input::only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return Redirect::back()->withMessage('Invalid credentials');
        }

        if (Auth::user()->role_id == 1) {
            return Redirect::to('/admin');
        }

        return Redirect::to('/home');
    });

    Route::get('/admin', ['middleware' => 'admin', 'uses' => 'AdminController@index']);
    Route::get('/admin/user/{id}', ['middleware' => 'admin', 'uses' => 'AdminController@edit']);
    Route::post('/admin/save/{id}', ['middleware' => 'admin', 'uses' => 'AdminController@save']);
    Route::post('admin/delete/{id}', ['middleware' => 'admin', 'uses' => 'AdminController@delete']);
    Route::get('admin/add', ['middleware' => 'admin', 'uses' => 'AdminController@add']);
    Route::post('admin/create', ['middleware' => 'admin', 'uses' => 'AdminController@create']);
    
    Route::get('/message', 'MessagesController@create');
    Route::post('/send', 'MessagesController@send');
    Route::get('/dialog', 'MessagesController@dialog');
    Route::get('/show/{id}', 'MessagesController@show');
    Route::post('/answer/{id}', 'MessagesController@answer');
    
    
    Route::get('/refresh', 'HomeController@refresh');
    Route::post('/save/{id}', 'HomeController@save');
    Route::get('/home', ['middleware' => 'auth', 'uses' => 'HomeController@index']);
    Route::get('/profile', ['middleware' => 'auth', 'uses' => 'HomeController@profile']);
});


