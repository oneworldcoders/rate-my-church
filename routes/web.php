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
    return redirect('/home');
});

Route::resource('churches', 'ChurchController');
Route::resource('questions', 'QuestionController');
Route::resource('ratings', 'RatingController')->except(['show']);
Route::resource('permissions', 'PermissionController')->except(['destroy', 'store', 'create']);
Route::resource('roles', 'RoleController');
Route::resource('surveys', 'SurveyController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/permissions', 'PermissionController@save')->name('permissions.save')->middleware('can:save,App\RoleUser');
Route::get('/church_questions/{church_question}', 'RatingController@view_responses')->name('ratings.view_responses')->middleware('can:viewResponses,App\Rating');

