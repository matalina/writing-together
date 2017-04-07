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

Route::get('/', 'FictionController@index')
    ->name('home');
Route::get('view/{id}', 'FictionController@view')
    ->name('view');

Route::get('login/{provider}', 'Auth\SocialiteController@redirectToProvider')
    ->name('login');
Route::get('login/{provider}/callback', 'Auth\SocialliteController@handleProviderCallback')
    ->name('login.callback');
Route::get('logout', 'Auth\SocialiteController@logout')
    ->name('logout');

Route::group(['middleware' => 'auth'], function () 
{
    Route::get('new', 'FictionController@create')
        ->name('new');
    Route::post('new', 'FictionController@store')
        ->name('doNew');
    
    Route::get('reply/{id}','FictionController@reply')
        ->name('reply');
    Route::post('reply', 'FictionController@post')
        ->name('doReply');
        
    Route::get('delete/{id}/{type}', 'FictionController@delete')
        ->name('delete')
        ->middleware('can.moderate');
});
