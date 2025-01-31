<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver("google")
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver("google")->user();
        $user = User::where('email', $googleUser->email)->first();
        if ($user) {
            // email already used, what we have todo? just link it with google
            $user->google_id = $googleUser->id;
            $user->save();
        } else {
            abort(403, 'Akun anda belum terdaftar, silahkan hubungi Administrator.');

            $user = User::updateOrCreate(
                ['google_id' => $googleUser->id],
                [
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Str::password(12),
                    'email_verified_at' => now(),
                    'active' => 1,
                ]
            );
        }

        if (!$user->active) {
            abort(403, 'Akun anda tidak aktif, hubungi Administrator.');
        }

        Auth::login($user);

        return redirect(route('dashboard'))
            ->with('success', __('messages.registration-logged-in-success'));
    }
}
