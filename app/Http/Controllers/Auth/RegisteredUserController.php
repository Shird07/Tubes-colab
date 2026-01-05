<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Menampilkan halaman registrasi
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Menyimpan data registrasi user
     * TANPA login otomatis
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input (TANPA lowercase)
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
            ],
        ]);

        // Simpan user ke database (email dipaksa lowercase)
        $user = User::create([
            'name' => $request->name,
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        // Event register (opsional, tetap aman)
        event(new Registered($user));

        // ❌ TIDAK LOGIN
        // ❌ TIDAK MASUK AKUN

        // Redirect + popup sukses
        return redirect()
            ->route('home')
            ->with('success', 'Akun berhasil dibuat. Silakan login.');
    }
}
