<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LOGIN PAGE
    |--------------------------------------------------------------------------
    */
    public function login()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }

        return view('auth.login');
    }

    /*
    |--------------------------------------------------------------------------
    | AUTHENTICATION
    |--------------------------------------------------------------------------
    */
    public function authenticate(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $key = Str::lower($validated['email']) . '|' . $request->ip();

        // LIMIT LOGIN ATTEMPT
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            return back()->withInput()->with(
                'error',
                "Terlalu banyak percobaan login. Coba lagi dalam {$seconds} detik."
            );
        }

        // LOGIN
        if (Auth::attempt([
            'email'  => $validated['email'],
            'password' => $validated['password'],
            'status' => 'aktif',
        ])) {

            RateLimiter::clear($key);

            $request->session()->regenerate();

            $user = Auth::user();

            // OPTIONAL AUTO HASH FIX
            if ($user && !Str::startsWith($user->password, '$2y$')) {
                $user->password = bcrypt($validated['password']);
                $user->save();
            }

            session([
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return $this->redirectByRole($user)
                ->with('success', 'Login berhasil');
        }

        RateLimiter::hit($key, 60);

        return back()->withInput()->with('error', 'Email atau password salah');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Berhasil logout');
    }

    /*
    |--------------------------------------------------------------------------
    | REDIRECT BY ROLE (FIX UTAMA)
    |--------------------------------------------------------------------------
    */
    private function redirectByRole($user)
    {
        return match ($user->role) {

            // ADMIN + INTERNAL ROLE
            'admin',
            'resepsionis',
            'pelayanan'
                => redirect()->route('pages.dashboard'),

            // PELANGGAN
            'pelanggan'
                => redirect()->route('pelanggan.dashboard'),

            // DEFAULT SAFE
            default
                => redirect()->route('login')
                    ->with('error', 'Role tidak valid'),
        };
    }
}
