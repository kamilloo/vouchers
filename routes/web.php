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

Route::get('/', 'WelcomeController@index')->name('welcome');

Route::get('/template-{id}', function ($id){
    return view('templates.template'.$id);
});


Auth::routes();


Route::middleware('auth')->group(function (){
    Route::get('/profile', 'Profile@index')->name('profile.index');
    Route::post('/profile/edit', 'Profile@update')->name('profile.update');
    Route::get('/profile/edit', 'Profile@edit')->name('profile.edit');
});
Route::get('/home', 'HomeController@index')->name('home');

Route::get('get-started', 'Starter@getStarted')->name('get-started');
