<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'role' => ['required', 'in:admin,user'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

    // Cek apakah ada admin yang sudah terdaftar
    $adminExists = User::where('role', 'admin')->exists();

    // Jika sudah ada admin dan user mencoba daftar sebagai admin, tolak
    if ($request->role === 'admin' && $adminExists) {
        return back()->withErrors([
            'role' => 'Registrasi admin tidak diizinkan. Silakan hubungi administrator.'
        ])->withInput();
    }

    // Atau batasi: hanya email tertentu yang bisa jadi admin
    $allowedAdminEmails = ['desi.gc123@gmail.com', 'admin@sipkbi.com'];
    if ($request->role === 'admin' && !in_array($request->email, $allowedAdminEmails)) {
        return back()->withErrors([
            'role' => 'Email Anda tidak memiliki izin untuk mendaftar sebagai admin.'
        ])->withInput();
    }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);
        if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
        }

        return redirect(route('dashboard', absolute: false));
    }
}
