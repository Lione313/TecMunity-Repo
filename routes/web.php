<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');

});

Route::get('/demo', function () {
    return 'el que lee esto es cabro';
});

Route::get('/bas/demon', function () {
    return 'el que lee esto es cabro';

});
Route::get('/demo', function () {
    return 'el que lee esto es cabro';
    

});

