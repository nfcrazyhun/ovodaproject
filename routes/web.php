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

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
Route::resources - request cheat sheet:
    GET /students (index)
    GET /students/create (create)
    GET /students/{id} (show)
    POST /students (store)
    GET /students/{id}/edit (edit)
    PATCH /students/update (update)
    DELETE /students/{id} (destroy)
 */
Route::resource('students','StudentController');
Route::resource('addresses','AddressController');