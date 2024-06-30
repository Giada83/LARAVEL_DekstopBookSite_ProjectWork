<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBookRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('author', 'categories')->get();
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();
        return view('books.create', compact('authors', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        if ($request->hasFile('cover')) {
            $coverFile = $request->file('cover');
            // $coverPath = 'covers/' . Str::uuid() . '.' . $coverFile->getClientOriginalExtension();
            $timestamp = now()->format('Ymd_His_u'); // Formato con microsecondi
            $extension = $coverFile->getClientOriginalExtension();
            $coverPath = "covers/{$timestamp}_bookcover.{$extension}";

            // Salva il file rinominato nella cartella pubblica
            $coverPath = $coverFile->storePubliclyAs('public', $coverPath);
        } else {
            $coverPath = null;
        }

        $book = Book::create([
            'author_id' => $request->input('author_id'),
            'title' => $request->input('title'),
            'cover' => $coverPath,
            'description' => $request->input('description'),
            'year' => $request->input('year'),
            'language' => $request->input('language'),
        ]);

        // Gestione delle categorie
        $book->categories()->sync($request->input('categories'));

        return redirect()->route('books.index')->with('success', 'Book added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        // Recupera un libro specifico e tutte le recensioni associate a questo libro
        $reviews = $book->reviews;

        return view('books.show', compact('book', 'reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        $categories = Category::all();
        return view('books.edit', compact('book', 'authors', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        if ($request->hasFile('cover')) {
            // Rimuovere il vecchio file di copertina, se esiste
            if ($book->cover) {
                Storage::delete($book->cover);
            }

            $coverFile = $request->file('cover');
            $timestamp = now()->format('Ymd_His_u'); // Formato con microsecondi
            $extension = $coverFile->getClientOriginalExtension();
            $coverPath = "covers/{$timestamp}_bookcover.{$extension}";

            // Salva il file rinominato nella cartella pubblica
            $coverPath = $coverFile->storePubliclyAs('public', $coverPath);
        } else {
            $coverPath = $book->cover;
        }

        // Aggiornare le informazioni del libro
        $book->update([
            'author_id' => $request->input('author_id'),
            'title' => $request->input('title'),
            'cover' => $coverPath,
            'description' => $request->input('description'),
            'year' => $request->input('year'),
            'language' => $request->input('language'),
        ]);

        // Gestione delle categorie
        $book->categories()->sync($request->input('categories'));

        return redirect()->route('books.index')->with('success', 'Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if ($book->cover) {
            Storage::delete($book->cover);
        }

        $book->categories()->detach();

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully');
    }

    // AGGIUNGI/RIMUOVI PREFERITI
    //aggiugnere un preferito
    public function addToFavorites(Book $book)
    {
        $user = Auth::user(); // Ottiene l'utente autenticato

        if (!$user) {
            return redirect()->route('login'); // Reindirizza l'utente non autenticato alla pagina di login
        }

        // Verifica se il libro esiste già nella tabella pivot
        if ($user->books()->where('book_id', $book->id)->exists()) {
            // Se esiste, aggiorna solo il campo is_favorite
            $user->books()->updateExistingPivot($book->id, ['is_favorite' => true]);
        } else {
            // Se non esiste, aggiungi il libro ai preferiti
            $user->books()->attach($book->id, ['is_favorite' => true]);
        }

        return redirect()->back(); // Reindirizza indietro alla pagina precedente 
    }

    // Funzione per rimuovere un libro dai preferiti dell'utente
    public function removeFromFavorites(Book $book)
    {
        $user = Auth::user(); // Ottiene l'utente autenticato
        $user->books()->updateExistingPivot($book->id, ['is_favorite' => false]); // aggiorna il campo a false

        // Recupera tutti i dati pivot dell'associazione specifica
        $pivotData = $user->books()->where('book_id', $book->id)->first()->pivot;
        // Controlla se lo stato è null, se sì, rimuove l'associazione
        //!$pivotData->is_favorite = is_favorite non è vero = falsy | $pivotData->is_favorite === false
        if (!$pivotData->is_favorite && is_null($pivotData->status)) {
            $user->books()->detach($book->id);
        }

        return redirect()->back();
    }

    // PAGINA DEI FAVORITI
    // visualizza la pagina dei libri preferiti dell'utente
    public function favorites()
    {
        $user = Auth::user(); // Ottiene l'utente autenticato
        $favoriteBooks = $user->books()->wherePivot('is_favorite', true)->get(); // Ottiene tutti i libri dell'utente che sono contrassegnati come preferiti
        $alreadyRead = $user->books()->wherePivot('status', 'already_read')->get();
        $reading = $user->books()->wherePivot('status', 'reading')->get();
        $wantToRead = $user->books()->wherePivot('status', 'want_to_read')->get();

        return view('books.favorites', compact('favoriteBooks', 'alreadyRead', 'reading', 'wantToRead')); // Carica la vista 'books.favorites' passando l'elenco dei libri preferiti
    }

    // AGGIORNARE STATUS DEL LIBRO
    public function updateBookStatus(Request $request, Book $book)
    {
        $user = Auth::user();
        $status = $request->input('status');

        // Verifica se il libro esiste già nella tabella pivot, se no aggiungilo con il nuovo stato
        if ($user->books()->where('book_id', $book->id)->exists()) {
            $user->books()->updateExistingPivot($book->id, ['status' => $status]);
        } else {
            $user->books()->attach($book->id, ['status' => $status]);
        }

        return redirect()->back();
    }

    // RIMUOVERE LO STATO DEL LIBRO
    public function removeBookStatus(Book $book)
    {
        $user = Auth::user();

        // Aggiorna lo stato del libro a null o a un valore predefinito
        $user->books()->updateExistingPivot($book->id, ['status' => null]);

        // Controlla se il libro non è nei preferiti e nel caso rimuove l'associazione
        $pivotData = $user->books()->where('book_id', $book->id)->first()->pivot;
        if (!$pivotData->is_favorite && is_null($pivotData->status)) {
            $user->books()->detach($book->id);
        }

        return redirect()->back();
    }
}
