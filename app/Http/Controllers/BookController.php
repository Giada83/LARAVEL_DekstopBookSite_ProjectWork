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
        $user = Auth::user(); // Ottiene l'utente autenticato

        if (!$user) {
            return redirect()->route('login'); // Reindirizza l'utente non autenticato alla pagina di login
        }
        $user->books()->syncWithoutDetaching([$book->id => ['is_favorite' => true]]); // Aggiunge il libro ai preferiti dell'utente
        //NB. syncWithoutDetaching è utilizzato nel contesto di relazioni many-to-many per aggiungere una relazione tra modelli senza rimuovere le altre relazioni esistenti che non sono esplicitamente indicate nella chiamata.

        return redirect()->back(); // Reindirizza indietro alla pagina precedente 
    }

    // Funzione per rimuovere un libro dai preferiti dell'utente
    public function removeFromFavorites(Book $book)
    {
        $user = Auth::user(); // Ottiene l'utente autenticato
        //$user->books()->updateExistingPivot($book->id, ['is_favorite' => false]); // Aggiorna il valore 'is_favorite' a false per il libro specificato
        $user->books()->detach($book->id); // Rimuove completamente la relazione dalla tabella ponte

        return redirect()->back();
    }

    // PAGINA DEI FAVORITI
    // visualizza la pagina dei libri preferiti dell'utente
    public function favorites()
    {
        $user = Auth::user(); // Ottiene l'utente autenticato
        $favoriteBooks = $user->books()->wherePivot('is_favorite', true)->get(); // Ottiene tutti i libri dell'utente che sono contrassegnati come preferiti

        return view('books.favorites', compact('favoriteBooks')); // Carica la vista 'books.favorites' passando l'elenco dei libri preferiti
    }
}
