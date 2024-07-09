<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $books = Book::with('author', 'categories')->orderBy('title')->paginate(10);
        return view('admin.books_index', compact('books'));
    }
}
