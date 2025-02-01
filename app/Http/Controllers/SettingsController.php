<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function __construct()
    {
        allowed_roles([User::ROLE_ADMIN]);
    }

    public function academyProfile(Request $request)
    {
        if ($request->method() === 'POST') {
            $rules = [
                'academy_name' => 'required|min:2|max:100',
                'founded_date' => 'required',
                'owner_name' => 'required|min:2|max:100',
            ];
            $request->validate($rules);

            Setting::saveAll([
                'academy.name' => $request->get('academy_name'),
                'academy.founded_date' => $request->get('founded_date'),
                'academy.owner_name' => $request->get('owner_name'),
            ]);
            $request->session()->flash('success', 'Profil Akademi berhasil diperbarui.');
            return back();
        }

        $data = [
            'academy_name' => Setting::get('academy.name', 'My Training Hub'),
            'founded_date' => Setting::get('academy.founded_date', '2010-01-01'),
            'owner_name' => Setting::get('academy.owner_name', 'John Doe'),
        ];

        return inertia('settings/AcademyProfile', [
            'data' => $data
        ]);
    }
}
