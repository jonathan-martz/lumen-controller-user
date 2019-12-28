<?php

use Illuminate\Support\Facades\Route;

Route::post('/user/view', [
    'middleware' => ['auth', 'xss', 'https'],
    'uses' => 'App\Http\Controllers\UserController@view'
]);
