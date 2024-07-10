<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::orderBy('surname', 'asc')->paginate(10);
        return view('authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request)
    {
        // Validazione dei dati e gestione dell'immagine del profilo
        $validatedData = $request->validated(); // Ottiene tutti i dati validati dalla richiesta

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $timestamp = now()->format('Ymd_His_u');
            $extension = $imageFile->getClientOriginalExtension();
            $imagePath = "authors/{$timestamp}_profile.{$extension}";

            // Salva il file rinominato nella cartella pubblica
            $imagePath = $imageFile->storePubliclyAs('public', $imagePath);

            $validatedData['image'] = $imagePath; // Aggiunge il percorso dell'immagine ai dati validati
        } else {
            // Se non viene fornita un'immagine, utilizza un'immagine di default
            $validatedData['image'] = 'storage\authors\default_profile.png';
        }

        // Creazione di un nuovo autore con i dati validati
        $author = Author::create($validatedData);

        // Reindirizza alla pagina di indice degli autori con un messaggio di successo
        return redirect()->route('authors.index')->with('success', 'Author created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        if ($request->hasFile('image')) {
            // Rimuovere l'immagine precedente, se esiste e non è quella di default
            if ($author->image && $author->image != 'authors/default_profile.png' && Storage::exists('public/' . $author->image)) {
                Storage::delete('public/' . $author->image);
            }

            $imageFile = $request->file('image');
            $timestamp = now()->format('Ymd_His_u');
            $extension = $imageFile->getClientOriginalExtension();
            $imagePath = "authors/{$timestamp}_profile.{$extension}";

            // Salva il file rinominato nella cartella pubblica
            $imagePath = $imageFile->storePubliclyAs('public', $imagePath);
        } else {
            // Se non viene fornito un nuovo file, mantieni l'immagine esistente
            $imagePath = $author->image;
        }

        $validatedData = $request->validated();
        $validatedData['image'] = $imagePath;

        $author->update($validatedData);

        return redirect()->route('authors.index')->with('success', 'Author updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('authors.index')->with('success', 'Author deleted successfully.');
    }
}
