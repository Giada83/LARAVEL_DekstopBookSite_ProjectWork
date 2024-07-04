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
    public function index(Request $request)
    {
        $sort = $request->query('sort', 'title_asc'); // Default 
        $categoryId = $request->query('category');

        $books = Book::select(['id', 'title', 'cover', 'author_id', 'created_at'])
            ->with('author')
            ->withAvg('reviews', 'rating')
            ->when($categoryId, function ($query, $categoryId) {
                return $query->whereHas('categories', function ($query) use ($categoryId) {
                    $query->where('categories.id', $categoryId);
                });
            })
            ->when($sort == 'title_asc', function ($query) {
                return $query->orderBy('title', 'asc');
            })
            ->when($sort == 'title_desc', function ($query) {
                return $query->orderBy('title', 'desc');
            })
            ->when($sort == 'author', function ($query) {
                return $query->orderBy(Author::select('name')->whereColumn('authors.id', 'books.author_id'), 'asc');
            })
            ->when($sort == 'recent', function ($query) {
                return $query->orderBy('created_at', 'desc');
            })
            ->when($sort == 'best_reviews', function ($query) {
                return $query->orderBy('reviews_avg_rating', 'desc');
            })
            // ->when($sort == 'year_asc', function ($query) {
            //     return $query->orderBy('year', 'asc');
            // })
            // ->when($sort == 'year_desc', function ($query) {
            //     return $query->orderBy('year', 'desc');
            // })
            // ->paginate(10);
            ->get();

        $authors = Author::select(['id', 'name'])->get();
        $categories = Category::all();
        $reviews = Review::all();

        return view('home.index', compact('books', 'authors', 'categories', 'reviews'));
    }
}
