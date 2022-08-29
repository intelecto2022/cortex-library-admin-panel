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

Route::prefix('settings')->name('settings.')->group(function() {
    Route::resource('/policies',\App\Http\Controllers\PolicyController::class);
    Route::resource('/categories', \App\Http\Controllers\CategoryController::class);
    Route::resource('/genres', \App\Http\Controllers\GenreController::class);
    Route::resource('/publishers', \App\Http\Controllers\PublishersController::class);
    Route::resource('/covers', \App\Http\Controllers\CoverController::class);
    Route::resource('/formats', \App\Http\Controllers\FormatController::class);
    Route::resource('/scripts', \App\Http\Controllers\ScriptController::class);
    Route::resource('/languages', \App\Http\Controllers\LanguageController::class);
});

Route::get('/', function () {
    return view('welcome');
});
