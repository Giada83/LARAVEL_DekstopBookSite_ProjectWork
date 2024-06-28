<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function userReviews()
    {
        $user = auth()->user(); // Recupera l'utente corrente autenticato
        $reviews = $user->reviews()->orderByDesc('created_at')->get(); // Recupera tutte le recensioni dell'utente

        return view('user.reviews', compact('reviews'));
    }
}
