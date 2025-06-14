<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class AdminAuthController extends Controller
{
    /**
     * Tampilkan form login admin.
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Proses login admin.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Coba untuk otentikasi menggunakan guard 'admin'
        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            // Jika berhasil, regenerate session dan arahkan ke dashboard
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        // Jika otentikasi gagal, kembalikan dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->withInput($request->only('email', 'remember'));
    }

    /**
     * Redirect ke Google OAuth
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Cari admin berdasarkan Google ID atau email
            $admin = Admin::where('google_id', $googleUser->id)
                         ->orWhere('email', $googleUser->email)
                         ->first();

            if ($admin) {
                // Update Google ID dan avatar jika belum ada
                if (!$admin->google_id) {
                    $admin->update([
                        'google_id' => $googleUser->id,
                        'avatar' => $googleUser->avatar,
                    ]);
                }
            } else {
                // Buat admin baru hanya jika email tertentu (opsional)
                // Atau Anda bisa membatasi hanya email tertentu yang bisa login
                $allowedEmails = [
                    'Warung@Mbadog.com', 
                    'admin@warungmbadog.com'
                    // Tambahkan email lain yang diizinkan
                ];

                if (!in_array($googleUser->email, $allowedEmails)) {
                    return redirect()->route('admin.login')
                        ->withErrors(['email' => 'Email Anda tidak memiliki akses admin.']);
                }

                $admin = Admin::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                ]);
            }

            // Login admin
            Auth::guard('admin')->login($admin, true);
            
            return redirect()->intended(route('admin.dashboard'));

        } catch (Exception $e) {
            return redirect()->route('admin.login')
                ->withErrors(['email' => 'Terjadi kesalahan saat login dengan Google.']);
        }
    }

    /**
     * Logout admin.
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    /**
     * Tampilkan halaman manajemen akun.
     */
    public function account()
    {
        return view('admin.account');
    }
    
    /**
     * Perbarui password admin.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $admin = Admin::find(Auth::guard('admin')->id());
        
        if (!$admin || !Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Password lama yang Anda masukkan salah.']);
        }

        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return back()->with('status', 'Password berhasil diubah!');
    }
}