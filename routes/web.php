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

Route::get('/', 'PagesController@index');

Route::get('/about', 'PagesController@about');

Route::get('/services', 'PagesController@services');

//it's gonna be hard to write every single route for the PostsController so we gonna use a shortcut 
Route::resource('posts', 'PostsController');//it's gonna automatically map routes to the functions in PostsController.php
Auth::routes();

Route::get('/dashboard', 'DashboardController@index')/*->name('home')*/;