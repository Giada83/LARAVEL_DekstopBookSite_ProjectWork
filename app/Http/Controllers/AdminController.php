<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // public function index()
    // {
    //     $books = Book::with('author', 'categories')->orderBy('title')->paginate(10);
    //     return view('admin.books_index', compact('books'));
    // }
    // public function index(Request $request)
    // {
    //     $query = Book::query();

    //     // Ricerca unica
    //     if ($request->has('search')) {
    //         $search = $request->input('search');

    //         $query->where(function ($q) use ($search) {
    //             $q->where('title', 'like', '%' . $search . '%')
    //                 ->orWhereHas('author', function ($q) use ($search) {
    //                     $q->where('name', 'like', '%' . $search . '%')
    //                         ->orWhere('surname', 'like', '%' . $search . '%');
    //                 })
    //                 ->orWhereHas('categories', function ($q) use ($search) {
    //                     $q->where('name', 'like', '%' . $search . '%');
    //                 });
    //         });
    //     }

    //     // Eseguire la query ordinata per titolo e paginata
    //     $books = $query->with('author', 'categories')->orderBy('title')->paginate(10);

    //     return view('admin.books_index', compact('books'));
    // }



    public function index(Request $request)
    {
        // Impostazioni di default per l'ordinamento
        $sort = $request->input('sort', 'title');
        $order = $request->input('order', 'asc');

        $query = Book::query();

        // Ricerca unica (se presente)
        if ($request->has('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhereHas('author', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%')
                            ->orWhere('surname', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('categories', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        // Ordinamento
        if ($sort == 'surname') {
            $query->select('books.*')
                ->join('authors', 'books.author_id', '=', 'authors.id')
                ->orderBy('authors.surname', $order);
        } elseif ($sort == 'category') {
            $query->select('books.*')
                ->join('book_category', 'books.id', '=', 'book_category.book_id')
                ->join('categories', 'book_category.category_id', '=', 'categories.id')
                ->orderBy('categories.name', $order);
        } else {
            $query->orderBy($sort, $order);
        }

        // Caricamento delle relazioni
        $query->with('author', 'categories');

        // Eseguire la query paginata
        $books = $query->paginate(10);

        return view('admin.books_index', compact('books', 'sort', 'order'));
    }
}
