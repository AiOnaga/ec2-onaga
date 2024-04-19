<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    Log::debug('Test log');
    return '<h1>Hello, Laravel!</h1>';
});