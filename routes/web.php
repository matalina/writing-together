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
    
Route::get('tag/{tag}', 'FictionController@tag')
    ->name('tag');    

Route::get('login/{provider}', 'Auth\SocialiteController@redirectToProvider')
    ->name('login');
Route::get('login/{provider}/callback', 'Auth\SocialiteController@handleProviderCallback')
    ->name('login.callback');


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
        
    Route::get('edit/{id}','FictionController@edit')
        ->name('edit');
    Route::post('edit', 'FictionController@update')
        ->name('doEdit');
    
    Route::get('delete/{id}/{type}', 'FictionController@delete')
        ->name('delete')
        ->middleware('can.moderate');
    
    Route::get('logout', 'Auth\SocialiteController@logout')
        ->name('logout');    
    
    Route::get('users','ProfileController@index')
        ->name('users');
    
    Route::get('profile/update', 'ProfileController@update')
        ->name('profile.update');
    Route::post('profile/update', 'ProfileController@save')
        ->name('profile.doUpdate');
});

Route::get('profile/{id?}','ProfileController@view')
    ->name('profile.view');
