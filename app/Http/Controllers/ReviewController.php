<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Support\Facades\Session;
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

        // Controlla se l'utente ha già una recensione per questo libro
        $existingReview = $request->user()->reviews()->where('book_id', $request->input('book_id'))->first();
        if ($existingReview) {
            Session::flash('review_error', true); // Imposta un flag per indicare che c'è un errore
            return redirect()->back();
        }

        $review = new Review([
            'book_id' => $request->input('book_id'),
            'review' => $request->input('review'),
            'rating' => $request->input('rating'),
        ]);

        // Salvataggio della recensione associata all'utente autenticato
        $request->user()->reviews()->save($review);

        return redirect()->back()->with('success', 'Review added successfully!');
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
        $this->authorize('update', $review); // Autorizzazione per verificare che l'utente possa modificare la recensione

        return view('reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        // 1.Salvataggio autorizzazione utente nella policy
        // 2.Registrazione della policy in AuthServiceProvider
        // 3.Validazione dei dati tramite UpdateReviewRequest

        // Aggiorna i campi della recensione con i dati validati
        $review->review = $request->input('review');
        $review->rating = $request->input('rating');

        // Salva la recensione aggiornata
        $review->save();

        return redirect()->route('user.reviews')->with('updRev_success', 'Review updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $bookId = $review->book_id;

        $review->delete();

        return redirect()->route('user.reviews')
            ->with('success', 'Review deleted successfully!')
            ->with('bookId', $bookId);
    }
}
