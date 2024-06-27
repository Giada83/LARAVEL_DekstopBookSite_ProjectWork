<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;

//HomepageLaravel
//Route::get('/', function () {return view('welcome');});

// Rotta per la homepage principale che carica i libri
Route::get('/', [BookController::class, 'index'])->name('home');
// Rotte di reindirizzamento 
Route::redirect('/home', '/');
Route::redirect('/books', '/');

// Rotte per il model Book - esclusa la index
Route::resource('books', BookController::class)->except('index');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profilo utente - autenticati
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Preferiti
Route::middleware(['auth'])->group(function () {
    Route::post('/books/{book}/favorite', [BookController::class, 'addToFavorites'])->name('books.addToFavorites');
    Route::post('/books/{book}/unfavorite', [BookController::class, 'removeFromFavorites'])->name('books.removeFromFavorites');
    // visualizza preferiti
    Route::get('/favorites', [BookController::class, 'favorites'])->name('books.favorites');
    //aggionare lo stato del libro
    Route::post('/books/{book}/update-status', [BookController::class, 'updateBookStatus'])->name('updateBookStatus');
});


require __DIR__ . '/auth.php';
