<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Exception;

class GoogleSocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        // redirect user to "login with Google account" page
        return Socialite::driver('google')->redirect();
    }

    public function handleCallback()
    {
        try {
            // get user data from Google
            $user = Socialite::driver('google')->user();

            // Attempt to find the user by social ID
            $existingUser = User::where('social_id', $user->id)->first();

            if ($existingUser) {
                // User already exists, log them in
                Auth::login($existingUser);
                return redirect('/dashboard');
            } else {
                // Check if a user with the same email exists
                $existingUser = User::where('email', $user->email)->first();

                if ($existingUser) {
                    // User exists with email, but not with social ID
                    if ($existingUser->social_type !== 'google') {
                        // Update user with Google social ID
                        $existingUser->social_id = $user->id;
                        $existingUser->social_type = 'google';
                        $existingUser->save();
                    }

                    // Log the user in
                    Auth::login($existingUser);
                    return redirect('/dashboard');
                } else {
                    // User does not exist, create a new user
                    $newUser = new User();
                    $newUser->name = $user->name;
                    $newUser->email = $user->email;
                    $newUser->social_id = $user->id;
                    $newUser->social_type = 'google';
                    // $newUser->password = bcrypt('my-google');
                    // Generate a random secure password (optional)
                    $randomPassword = Str::random(12); // Generate a 12-character random string

                    // Hash the password securely
                    $newUser->password = Hash::make($randomPassword);

                    // Attempt to save the new user
                    try {
                        $newUser->save();
                    } catch (\Exception $e) {
                        // Handle any exceptions if necessary
                        dd($e->getMessage());
                    }

                    // Log the user in
                    Auth::login($newUser);
                    return redirect('/dashboard');
                }
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
