<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function userReviews()
    {
        $user = auth()->user(); // Recupera l'utente corrente autenticato
        $reviews = $user->reviews()
            ->with(['book:id,title,author_id', 'book.author:id,name,surname']) // Carica i dati del libro e dell'autore
            ->orderByDesc('updated_at')
            ->get();

        return view('user.reviews', compact('reviews'));
    }

    public function dashboard()
    {
        $user = Auth::user(); // Recupera l'utente autenticato

        $randomBooks = Book::with('author', 'categories', 'reviews')->inRandomOrder()->take(6)->get();

        return view('user.dashboard', compact('user', 'randomBooks'));
    }
}
