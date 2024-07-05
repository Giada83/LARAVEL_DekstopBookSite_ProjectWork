<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function home()
    {
        // Ultimi libri inseriti
        $latestBooks = Book::with('author', 'categories', 'reviews')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // libri con votazione media più alta
        $topRatedBooks = Book::withAvg('reviews', 'rating')
            ->orderBy('reviews_avg_rating', 'desc')
            ->take(5)
            ->get();

        return view('home', [
            'latestBooks' => $latestBooks, 'topRatedBooks' => $topRatedBooks
        ]);
    }
}
