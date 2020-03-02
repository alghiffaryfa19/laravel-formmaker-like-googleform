<?php
use App\Form;
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
    $form = Form::all();
    return view('welcome', compact('form'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('category', 'CategoryController');
Route::post('category/update', 'CategoryController@update')->name('category.update');
Route::get('category/destroy/{id}', 'CategoryController@destroy');
Route::resource('form', 'FormController');
Route::post('form/update', 'FormController@update')->name('form.update');
Route::get('form/destroy/{id}', 'FormController@destroy');
Route::resource('result', 'ResultController');
Route::post('result/update', 'ResultController@update')->name('result.update');
Route::get('result/destroy/{id}', 'ResultController@destroy');
