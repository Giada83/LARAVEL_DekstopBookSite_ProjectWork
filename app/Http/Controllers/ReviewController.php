<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Book;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;

class ReviewController extends Controller
{
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
    public function store(StoreReviewRequest $request)
    {
        // Verifica se l'utente è autenticato
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Devi effettuare il login per lasciare una recensione.');
        }

        // Verifica se l'utente ha già lasciato una recensione per questo libro
        $userId = auth()->user()->id;
        $bookId = $request->input('book_id');

        $existingReview = Review::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->exists();

        if ($existingReview) {
            return redirect()->back()->with('error', 'Hai già lasciato una recensione per questo libro.');
        }

        // Creazione della recensione
        $review = new Review();
        $review->user_id = auth()->user()->id; // Ottiene l'id dell'utente autenticato
        $review->book_id = $request->input('book_id');
        $review->rating = $request->input('rating');
        $review->review = $request->input('review');
        $review->save();

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
