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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('churches', 'ChurchController');
Route::resource('questions', 'QuestionController');
//Route::resource('users', 'UserController');
Route::resource('ratings', 'RatingController');
Route::resource('permissions', 'PermissionController')->except(['destroy', 'store']);
Route::resource('roles', 'RoleController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index')->name('admin');
Route::post('/permissions', 'PermissionController@save')->name('permissions.save');
