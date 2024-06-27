<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::select(['id', 'title', 'cover', 'author_id'])
            ->take(6)  // Limita la query a 10 risultati
            ->get();
        $authors = Author::all(); //relazione uno a molti
        return view('home', compact('books', 'authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('books.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }

    // AGGIUNGI/RIMUOVI PREFERITI
    public function addToFavorites(Book $book)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login'); // Gestisci l'utente non autenticato
        }
        $user->books()->syncWithoutDetaching([$book->id => ['is_favorite' => true]]);

        return redirect()->back()->with('success', 'Book added to favorites.');
    }

    public function removeFromFavorites(Book $book)
    {
        $user = Auth::user();
        $user->books()->updateExistingPivot($book->id, ['is_favorite' => false]);

        return redirect()->back()->with('success', 'Book removed from favorites.');
    }

    // PAGINA DEI FAVORITI
    public function favorites()
    {
        $user = Auth::user();
        $favoriteBooks = $user->books()->wherePivot('is_favorite', true)->get();

        return view('books.favorites', compact('favoriteBooks'));
    }
}
