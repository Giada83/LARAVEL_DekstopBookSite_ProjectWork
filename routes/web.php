<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;

//HomepageLaravel
//Route::get('/', function () {return view('welcome');});

// Rotta per la homepage principale che carica i libri
Route::get('/', [PageController::class, 'home'])->name('home');
// Rotte di reindirizzamento 
Route::redirect('/home', '/');

// Rotte per il model Book 
Route::resource('books', BookController::class);

Route::middleware('auth')->group(function () {
    //Rotte per il model Review - esculsa la index
    Route::resource('reviews', ReviewController::class)->except('index');
    Route::get('/user/reviews', [UserController::class, 'userReviews'])->name('user.reviews'); //recensioni utente
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profilo utente - CRUD
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Preferiti e stati di lettura
Route::middleware(['auth'])->group(function () {
    Route::post('/books/{book}/favorite', [BookController::class, 'addToFavorites'])->name('books.addToFavorites');
    Route::post('/books/{book}/unfavorite', [BookController::class, 'removeFromFavorites'])->name('books.removeFromFavorites');
    // visualizza preferiti
    Route::get('/favorites', [BookController::class, 'favorites'])->name('books.favorites');
    //aggionare lo stato del libro
    Route::post('/books/{book}/update-status', [BookController::class, 'updateBookStatus'])->name('updateBookStatus');
    //rimuovere lo stato del libro
    Route::post('/books/{book}/remove-status', [BookController::class, 'removeBookStatus'])->name('books.removeBookStatus');
});


require __DIR__ . '/auth.php';
