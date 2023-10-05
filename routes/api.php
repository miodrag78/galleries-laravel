<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Ruta za registraciju
Route::post('/register', 'AuthController@register');

// Ruta za prijavu
Route::post('/login', 'AuthController@login');

// Ruta za prijavljenog korisnika
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});