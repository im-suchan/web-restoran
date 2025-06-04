<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    /**
     * Tampilkan form login admin.
     */
    public function showLoginForm()
    {
        // Menyesuaikan path dengan folder: resources/views/admin/auth/login.blade.php
        return view('admin.auth.login');
    }

    /**
     * Proses login admin.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Coba login menggunakan guard admin
        if (Auth::guard('admin')->attempt($credentials)) {
            // Jika berhasil, arahkan ke dashboard admin
            return redirect()->route('admin.dashboard');
        }

        // Jika gagal, kembali dengan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    /**
     * Logout admin.
     */
    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login');
    }
    public function account()
{
    return view('admin.account'); // Buat file admin/account.blade.php
}
    public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required'],
        'new_password' => ['required', 'confirmed', 'min:6'],
    ]);

    $admin = Auth::guard('admin')->user();

    if (!Hash::check($request->current_password, $admin->password)) {
        return back()->withErrors(['current_password' => 'Password lama salah.']);
    }

    $admin->password = Hash::make($request->new_password);
    $admin->save();

    return back()->with('status', 'Password berhasil diubah.');
}
}
