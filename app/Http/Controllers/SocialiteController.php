<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;


class SocialiteController extends Controller
{
    //
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
{
    try {
        $userFromGoogle = Socialite::driver('google')->stateless()->user();

        // Cek apakah user sudah ada di database berdasarkan email
        $userFromDb = User::where('email', $userFromGoogle->getEmail())->first();

        if (!$userFromDb) {
            // Jika user belum ada, buat user baru
            $userFromDb = new User();
            $userFromDb->email = $userFromGoogle->getEmail();
            $userFromDb->google_id = $userFromGoogle->getId();
            $userFromDb->name = $userFromGoogle->getName();
            $userFromDb->password = bcrypt('password'); // Tambahkan password dummy

            $userFromDb->save();
        } else {
            // Jika user sudah ada tetapi belum memiliki google_id, update datanya
            if (!$userFromDb->google_id) {
                $userFromDb->google_id = $userFromGoogle->getId();
                $userFromDb->save();
            }
        }

        // Login user
        auth('web')->login($userFromDb, true);
        session()->regenerate();

        return redirect('/');

    } catch (\Exception $e) {
        return redirect('/login')->with('error', 'Terjadi kesalahan saat login.');
    }
}

    public function logout(Request $request)
    {
        auth('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
