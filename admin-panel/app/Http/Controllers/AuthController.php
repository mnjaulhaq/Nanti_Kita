<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpVerificationMail;
use Carbon\Carbon;

class AuthController extends Controller
{
    // Halaman Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses Login (Username + Password)
    public function login(Request $request)
    {
        // 1. Validasi input form login
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // 2. Coba autentikasi menggunakan Auth::attempt
        if (Auth::attempt($credentials)) {
            // Jika sukses login, perbarui session
            $request->session()->regenerate();

            // Alihkan langsung ke route dashboard admin kalian
            return redirect()->intended('/admin');
        }

        // 3. Jika gagal (username/password salah), balikkan ke halaman login dengan pesan error
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput($request->only('username'));
    }

    // Halaman Register
    public function showRegister()
    {
        return view('auth.register');
    }

    // 1. PROSES REGISTRASI MANUAL & KIRIM OTP
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Simpan data user ke database (status email_verified_at masih NULL)
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generate 6 Digit Angka OTP Acak
        $otpCode = rand(100000, 999999);

        // Simpan kode OTP ke tabel otps
        DB::table('otps')->insert([
            'username' => $request->username,
            'otp_code' => $otpCode,
            'expires_at' => Carbon::now()->addMinutes(5), // Kedaluwarsa dalam 5 menit
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Kirim email OTP menggunakan Mail Class yang sudah dibuat
        Mail::to($request->email)->send(new OtpVerificationMail($otpCode));

        // Arahkan admin ke halaman verifikasi OTP dengan melempar data username via session
        return redirect()->route('otp.view')->with([
            'success' => 'Registrasi berhasil! Silakan cek Gmail Anda untuk kode OTP.',
            'verify_username' => $request->username
        ]);
    }

    // 2. TAMPILAN HALAMAN INPUT OTP
    public function showOtpForm()
    {
        // Mencegah akses langsung ke halaman OTP jika tidak ada session registrasi aktif
        if (!session('verify_username')) {
            return redirect('/register-admin');
        }
        return view('auth.otp');
    }

    // 3. PROSES VALIDASI OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'otp_code' => 'required|string|digits:6',
        ]);

        // Cari OTP yang cocok dan belum kedaluwarsa
        $otpData = DB::table('otps')
            ->where('username', $request->username)
            ->where('otp_code', $request->otp_code)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$otpData) {
            return back()->withErrors(['otp_code' => 'Kode OTP salah atau telah kedaluwarsa.'])
                ->withInput();
        }

        // Jika valid, verifikasi status email user di tabel users
        User::where('username', $request->username)->update([
            'email_verified_at' => Carbon::now()
        ]);

        // Hapus kode OTP lama dari database agar tidak bisa dipakai lagi
        DB::table('otps')->where('username', $request->username)->delete();

        return redirect('/login')->with('success', 'Akun admin Anda berhasil diverifikasi! Silakan login.');
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}