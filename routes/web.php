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

Route::get('/test', 'TestController@index');

Route::get('/', function () {
    // session()->flush();
    return view('index');
})->name('home');

// chef CRUD
Route::resource('chefs', 'ChefController');

Route::middleware('role')->group(function() {
    // recipe CRUD
    Route::resource('recipes', 'RecipeController');
});

Route::post('/change-role', 'IndexController@changeRole')->name('change-role');
