<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function home()
    {
        $books = Book::select(['id', 'title', 'cover', 'author_id'])
            ->take(20)  // Limita la query a 10 risultati
            ->get();
        $authors = Author::all(); //relazione uno a molti
        $categories = Category::all();
        return view('home', compact('books', 'authors', 'categories'));
    }
}
