<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Socialite;

class GoogleController extends Controller
{
    //
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->withErrors(['email' => 'La connexion avec Google a échoué ou été annulée.']);
        }

        $user = User::where('google_id', $googleUser->getId())->first();

        if (! $user) {
            $user = User::where('email', $googleUser->getEmail())->first();
        }

        if (! $user) {
            $user = new User();
            $user->name = $googleUser->getName();
            $user->email = $googleUser->getEmail();
        }

        $user->google_id = $googleUser->getId();
        $user->save();

        Auth::login($user);
        request()->session()->regenerate();

        return redirect()->intended(route('livres.index'));
    }
}
