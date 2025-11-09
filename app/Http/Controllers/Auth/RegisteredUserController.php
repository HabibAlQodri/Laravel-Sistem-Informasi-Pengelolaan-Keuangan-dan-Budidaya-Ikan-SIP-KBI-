<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

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
    public function store(Request $request)
    {
        try {
            // Jika request dari form registrasi publik (bukan API admin)
            if ($request->expectsJson()) {
                // Untuk admin menambah user baru via API
                $validated = $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ], [
                    'name.required' => 'Nama wajib diisi',
                    'email.required' => 'Email wajib diisi',
                    'email.email' => 'Format email tidak valid',
                    'email.unique' => 'Email sudah terdaftar',
                    'password.required' => 'Password wajib diisi',
                    'password.confirmed' => 'Konfirmasi password tidak sesuai',
                ]);

                // Tentukan role berdasarkan email (aturan otomatis)
                $role = in_array($validated['email'], ['desi.gc123@gmail.com', 'admin2@gmail.com']) ? 'admin' : 'user';

                $user = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'password' => Hash::make($validated['password']),
                    'role' => $role,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'User berhasil ditambahkan',
                    'data' => $user
                ], 201);

            } else {
                // Untuk registrasi publik
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);

                // Tentukan role berdasarkan email (aturan otomatis)
                $role = in_array($request->email, ['desi.gc123@gmail.com', 'admin2@gmail.com']) ? 'admin' : 'user';

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => $role,
                ]);

                event(new Registered($user));
                Auth::login($user);

                return redirect(route('dashboard', absolute: false));
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;

        } catch (\Exception $e) {
            Log::error('Error storing user: ' . $e->getMessage());

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menambahkan user: ' . $e->getMessage()
                ], 500);
            }
            throw $e;
        }
    }

    /**
     * Display a listing of users (untuk admin).
     */
    public function index()
    {
        try {
            $users = User::orderBy('created_at', 'desc')->get();

            return response()->json([
                'success' => true,
                'message' => 'Data user berhasil dimuat',
                'data' => $users
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error loading users: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data user: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified user.
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Data user berhasil dimuat',
                'data' => $user
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);

        } catch (\Exception $e) {
            Log::error('Error showing user: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data user: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified user (untuk admin).
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $rules = [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            ];

            // Jika password diisi, tambahkan validasi password
            if ($request->filled('password')) {
                $rules['password'] = ['required', 'confirmed', Rules\Password::defaults()];
            }

            $validated = $request->validate($rules, [
                'name.required' => 'Nama wajib diisi',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
                'password.required' => 'Password wajib diisi',
                'password.confirmed' => 'Konfirmasi password tidak sesuai',
            ]);

            // Tentukan role berdasarkan email (aturan otomatis)
            $role = in_array($validated['email'], ['desi.gc123@gmail.com', 'admin2@gmail.com']) ? 'admin' : 'user';

            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->role = $role;

            // Update password hanya jika diisi
            if ($request->filled('password')) {
                $user->password = Hash::make($validated['password']);
            }

            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'User berhasil diperbarui',
                'data' => $user
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui user: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified user (untuk admin).
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            // Cek apakah user yang akan dihapus adalah user yang sedang login
            if (Auth::check() && Auth::id() == $id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak dapat menghapus akun Anda sendiri'
                ], 403);
            }

            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User berhasil dihapus'
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);

        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus user: ' . $e->getMessage()
            ], 500);
        }
    }
}
