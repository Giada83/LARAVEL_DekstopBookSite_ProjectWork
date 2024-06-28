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
    {   // 1. Il form request `StoreReviewRequest` esegue automaticamente le regole di validazione.
        //Se le regole non sono rispettate, Laravel gestirà il reindirizzamento automaticamente.

        // Controlla se l'utente ha già una recensione per questo libro
        $existingReview = $request->user()->reviews()->where('book_id', $request->input('book_id'))->first();

        if ($existingReview) {
            Session::flash('review_error', 'Hai già inviato una recensione per questo libro.');
            return redirect()->back();
        }

        $review = new Review([
            'book_id' => $request->input('book_id'),
            'review' => $request->input('review'),
            'rating' => $request->input('rating'),
        ]);

        // Salvataggio della recensione associata all'utente autenticato
        $request->user()->reviews()->save($review);

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
