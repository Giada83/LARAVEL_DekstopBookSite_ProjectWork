<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Book;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;

class ReviewController extends Controller
{

    public function create()
    {
        //
    }

    public function store(StoreReviewRequest $request)
    {   // Il form request `StoreReviewRequest` esegue automaticamente le regole di validazione.
        // Se le regole non sono rispettate, Laravel gestirà il reindirizzamento automaticamente.

        // Verifica se l'utente ha già lasciato una recensione per questo libro
        $userId = auth()->user()->id;  // Ottiene l'ID dell'utente autenticato
        $bookId = $request->input('book_id');  // Ottiene l'ID del libro dalla richiesta

        // Query per verificare se esiste già una recensione per questo utente e libro
        $existingReview = Review::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->exists();

        // Se esiste già una recensione, reindirizza indietro con un messaggio di errore
        if ($existingReview) {
            return redirect()->back()->with('error', 'Hai già lasciato una recensione per questo libro.');
        }

        // Creazione di una nuova istanza di Review
        $review = new Review([
            'book_id' => $request->input('book_id'),
            'review' => $request->input('review'),
            'rating' => $request->input('rating'),
        ]);

        // Salvataggio della recensione associata all'utente autenticato
        $request->user()->reviews()->save($review);

        // Redirect con messaggio di successo
        return redirect()->back()->with('success', 'Recensione aggiunta con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
