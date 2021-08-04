<?php

use App\Http\Livewire\Posts;
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
    return view('show_page');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/post', 'PostController');


Route::get('/livewire/posts','PostController@livewire_index')->name('livewire.posts');
//Route::get('/livewire/create','PostController@create_post')->name('livewire.create');

Route::get('/livewire/create','PostController@livewire_create')->name('livewire.create');

