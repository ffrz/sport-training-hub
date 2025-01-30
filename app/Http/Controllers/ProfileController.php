<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        return inertia('profile/Edit');
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $rules = [
            'name' => 'required|min:2|max:100',
            'email' => 'email|min:3|max:255',
        ];
        $messages = [
            'name.required' => 'Nama harus diisi',
            'name.min' => 'Nama minimal 2 karakter',
            'name.max' => 'Nama maksimal 100 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.max' => 'Email terlalu panjang, maksimal 255 karakter',
        ];

        $request->validate($rules, $messages);
        $user = User::find(Auth::user()->id);
        $user->fill($request->only(['name', 'email']));

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();
        $request->session()->flash('success', 'Profil berhasil diperbarui.');

        return back();
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => 'required|confirmed|min:5',
        ], [
            'current_password.required' => 'Kata sandi sekarang ini harus diisi.',
            'current_password.current_password' => 'Kata sandi yang anda masukkan salah.',
            'password.required' => 'Kata sandi baru ini harus diisi.',
            'password.confirmed' => 'Kata sandi yang anda konfirmasi salah.',
            'password.min' => 'Kata sandi minimal 5 karakter.',
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $request->session()->flash('success', 'Password berhasil diperbarui.');

        return back();
    }
}
