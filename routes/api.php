<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GalleriesController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Rute za autentifikaciju
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->get('/user', [AuthController::class, 'user']);
Route::post('/logout', [AuthController::class, 'logout']);

// Rute za galerije
Route::get('/galleries', [GalleriesController::class, 'index']);
Route::get('/galleries/{gallery}', [GalleriesController::class, 'show']);
Route::post('/create', [GalleriesController::class, 'store'])->middleware('auth');
Route::put('/edit/{gallery}', [GalleriesController::class, 'update'])->middleware('auth');
Route::delete('/delete/{gallery}', [GalleriesController::class, 'destroy'])->middleware('auth');

// Rute za komentare
Route::get('/galleries/{gallery}/comments', [CommentController::class, 'show']); // Prikazivanje komentara za galeriju
Route::post('/galleries/{gallery}/comments', [CommentController::class, 'store'])->middleware('auth'); // Dodavanje komentara za galeriju
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->middleware('auth'); // Brisanje komentara

//Preostale rute
Route::get('/authors/{author}/galleries', [AuthorController::class, 'show']); // Prikazivanje galerija autora

