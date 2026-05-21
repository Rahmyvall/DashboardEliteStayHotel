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
    | Halaman Login
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
    | Proses Login
    |--------------------------------------------------------------------------
    */
    public function authenticate(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required|email:rfc,dns',
            'password' => 'required|string|min:8|max:100',
        ]);

        $throttleKey =
            Str::lower($validated['email']) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            return back()
                ->withInput()
                ->with('error', "Terlalu banyak percobaan login. Coba lagi dalam {$seconds} detik.");
        }

        if (Auth::attempt([
            'email'    => $validated['email'],
            'password' => $validated['password'],
            'status'   => 'aktif',
        ])) {

            RateLimiter::clear($throttleKey);

            $request->session()->regenerate();

            session([
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return $this->redirectByRole(Auth::user())
                ->with('success', 'Login berhasil');
        }

        RateLimiter::hit($throttleKey, 60);
        sleep(1);

        return back()
            ->withInput()
            ->with('error', 'Email atau password salah');
    }

    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Berhasil logout');
    }

    /*
    |--------------------------------------------------------------------------
    | Redirect sesuai role
    |--------------------------------------------------------------------------
    */
    private function redirectByRole($user)
    {
        return match ($user->role) {

            'admin' => redirect()->route('admin.dashboard'),

            'resepsionis' => redirect()->route('resepsionis.dashboard'),

            'pelanggan' => redirect()->route('pelanggan.dashboard'),

            default => redirect()->route('login')->with('error', 'Role tidak valid'),
        };
    }
}
