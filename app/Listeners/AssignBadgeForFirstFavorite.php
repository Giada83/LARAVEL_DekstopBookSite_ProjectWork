<?php

namespace App\Listeners;

use App\Events\BookFavorited;
use App\Models\Badge;

class AssignBadgeForFirstFavorite
{
    public function handle(BookFavorited $event)
    {
        $user = $event->user;

        // Controlla se l'utente ha già aggiunto un libro ai preferiti
        if ($user->books()->wherePivot('is_favorite', true)->count() === 1) {
            // Controlla se l'utente non ha già ricevuto il badge
            $badge = Badge::where('name', 'Primo Libro ai Preferiti')->first();
            if ($badge && !$user->badges->contains($badge->id)) {
                $user->badges()->attach($badge->id);

                // Imposta il messaggio di notifica flash
                session()->flash('badge_message', "Complimenti, hai vinto il badge \"{$badge->name}\"!");
            }
        }
    }
}
