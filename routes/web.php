<?php

use Illuminate\Support\Facades\Route;

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

// Top
Route::get('/', 'HomeController@index')->name('home');

// folder関連
Route::get('/folders/new', 'FolderController@new')->name('folders.new');
Route::post('/folders/create', 'FolderController@create')->name('folders.create');

// task関連
Route::get('/folders/{id}/tasks', 'TaskController@index')->name('tasks.index');
Route::get('/folders/{id}/tasks/new', 'TaskController@new')->name('tasks.new');
Route::post('/folders/{id}/tasks/create', 'TaskController@create')->name('tasks.create');
Route::get('/folders/{id}/tasks/{task_id}/edit', 'TaskController@edit')->name('tasks.edit');
Route::post('/folders/{id}/tasks/{task_id}/update', 'TaskController@update')->name('tasks.update');

// Auth
Auth::routes();