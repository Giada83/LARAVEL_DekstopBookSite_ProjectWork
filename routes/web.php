<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleSocialiteController;

// Homepage
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::redirect('/home', '/'); // Rotta di reindirizzamento 

// rotte Google Login
Route::get('auth/google', [GoogleSocialiteController::class, 'redirectToGoogle']);  // redirect to google login
Route::get('callback/google', [GoogleSocialiteController::class, 'handleCallback']);    // callback route after google account chosen

// Visualizzazione e ricerca libri
Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
Route::get('/books', [BookController::class, 'index'])->name('books.index');

// Amministratore - CRUD 
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth'])->name('admin.dashboard');

Route::resource('books', BookController::class)->except('index', 'show');

// Dettaglio libro
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

// Utenti loggati
Route::middleware('auth')->group(function () {
    //Rotte per il model Review - esclusa la index
    Route::resource('reviews', ReviewController::class)->except('index');
    // Visualizzare recensioni per un utente
    Route::get('/user/reviews', [UserController::class, 'userReviews'])->name('user.reviews');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('user.dashboard');
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
    Route::get('/favorites', [BookController::class, 'favorites'])->name('user.favorites');
    // visualizza stato di lettura
    Route::get('/library', [BookController::class, 'library'])->name('user.library');
    //aggiornare lo stato del libro
    Route::post('/books/{book}/update-status', [BookController::class, 'updateBookStatus'])->name('updateBookStatus');
    //rimuovere lo stato del libro
    Route::post('/books/{book}/remove-status', [BookController::class, 'removeBookStatus'])->name('books.removeBookStatus');
});

require __DIR__ . '/auth.php';
