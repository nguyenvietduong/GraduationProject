<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($provider = 'google')
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        // Use stateless() temporarily for debugging
        $getInfo = Socialite::driver($provider)->stateless()->user();

        $user = $this->createUser($getInfo, $provider);

        // Log the user in
        auth()->login($user);

        // Check if the user is authenticated
        if (auth()->check()) {
            // Redirect to the desired location
            return redirect()->to('https://graduationproject.test');
        } else {
            // Debugging: Log an error or return a response indicating failure
            \Log::error('User login failed after OAuth callback');
            return redirect()->route('login')->withErrors('Failed to log in. Please try again.');
        }
    }

    function createUser($getInfo, $provider)
    {
        $user = User::where('provider_id', $getInfo->id)->first();

        if (!$user) {
            $user = User::create([
                'full_name' => $getInfo->name,
                'email' => $getInfo->email,
                'provider' => $provider,
                'provider_id' => $getInfo->id,
            ]);
        }

        return $user;
    }
}
