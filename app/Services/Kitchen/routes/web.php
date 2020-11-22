<?php

/*
|--------------------------------------------------------------------------
| Service - Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for this service.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Services\Kitchen\Http\Controllers\RecipeController;

Route::group(['prefix' => 'kitchen'], function() {

    // The controllers live in src/Services/Kitchen/Http/Controllers
    // Route::get('/', 'UserController@index');

    Route::get('/recipes/new', function() {
        return view('kitchen::new');
    });

    Route::post('/recipes', [RecipeController::class, 'add']);

    Route::get('/', function() {
        return view('kitchen::welcome');
    });

});
