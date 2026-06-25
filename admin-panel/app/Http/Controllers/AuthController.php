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

    public function register(Request $request)
    {
        $request->validate([
            // Username: min 5 karakter, wajib huruf dulu baru boleh simbol/angka
            'username' => [
                'required',
                'min:5',
                'unique:users,username',
                'regex:/^[a-zA-Z][a-zA-Z0-9._-]*$/'
            ],
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            // Display Name: Wajib diawali huruf, tanpa simbol, sinkron dengan front-end
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z][a-zA-Z0-9\s]*$/'
            ],
        ], [
            // Custom Pesan Error Username
            'username.required' => 'Username wajib diisi, tidak boleh kosong.',
            'username.min' => 'Username minimal harus 5 karakter.',
            'username.unique' => 'Username sudah terdaftar.',
            'username.regex' => 'Username harus diawali dengan huruf dan tidak boleh hanya berisi simbol.',

            // Custom Pesan Error Email & Password
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan akun lain.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',

            // Custom Pesan Error Display Name
            'name.required' => 'Display name tidak boleh kosong.',
            'name.regex' => 'Display name harus diawali dengan huruf dan tidak boleh mengandung simbol atau angka di awal.',
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
            'expires_at' => Carbon::now('Asia/Jakarta')->addMinutes(5),
            'created_at' => Carbon::now('Asia/Jakarta'),
            'updated_at' => Carbon::now('Asia/Jakarta'),
        ]);

        // Kirim email OTP menggunakan Mail Class yang sudah dibuat
        Mail::to($request->email)->send(new OtpVerificationMail($otpCode));

        // 🌟 UPDATE: Simpan username DAN email ke session untuk dipakai di halaman OTP
        session()->put('verify_username', $request->username);
        session()->put('email', $request->email);

        return redirect()->route('otp.view')->with([
            'success' => 'Registrasi berhasil! Silakan cek Gmail Anda untuk kode OTP.',
        ]);
    }

    // 2. TAMPILAN HALAMAN INPUT OTP
    public function showOtpForm()
    {
        // Mencegah akses langsung ke halaman OTP jika tidak ada session registrasi aktif
        if (!session()->has('verify_username')) {
            return redirect('/register-admin');
        }

        // 🌟 UPDATE: Pertahankan token username dan alamat email agar tidak hangus saat di-refresh
        session()->keep(['verify_username', 'email']);
        return view('auth.otp');
    }

    // 3. PROSES VALIDASI OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp_code' => 'required|numeric',
        ], [
            'otp_code.required' => 'Kode OTP wajib diisi.',
            'otp_code.numeric' => 'Kode OTP harus berupa angka.',
        ]);

        // Baca username murni dari session Laravel
        $verifyUsername = session('verify_username');

        if (!$verifyUsername) {
            return redirect('/register-admin')->withErrors(['username' => 'Sesi verifikasi telah berakhir, silakan registrasi ulang.']);
        }

        // Ambil data OTP berdasarkan username dari database
        $otpData = DB::table('otps')->where('username', $verifyUsername)->first();

        // 🌟 FIX TIMEZONE SINKRONISASI: Paksa interpretasi string database ke Timezone Asia/Jakarta
        $isExpired = $otpData ? Carbon::parse($otpData->expires_at, 'Asia/Jakarta')->isPast() : true;

        // 2. JIKA OTP SALAH ATAU KADALUWARSA
        if (!$otpData || $request->otp_code != $otpData->otp_code || $isExpired) {
            if ($otpData && $isExpired) {
                // Hapus user bodong dari database karena OTP sudah hangus
                User::where('username', $verifyUsername)->delete();
                DB::table('otps')->where('username', $verifyUsername)->delete();
                session()->forget(['verify_username', 'email']);

                return redirect('/register-admin')->with('otpExpired', 'Durasi OTP telah kadaluarsa (lebih dari 5 menit). Data Anda dihapus, silakan registrasi ulang.');
            }

            // Jika murni kodenya salah ketik, pertahankan session username & email agar user bisa mencoba lagi
            session()->keep(['verify_username', 'email']);
            return back()->withErrors(['otp_code' => 'Kode OTP salah. Silakan periksa kembali email Anda.']);
        }

        // 3. JIKA OTP BENAR DAN BELUM KADALUWARSA (Proses Login Otomatis)
        $user = User::where('username', $verifyUsername)->first();
        if ($user) {
            $user->email_verified_at = now();
            $user->save();

            // Hapus OTP yang sudah terpakai
            DB::table('otps')->where('username', $verifyUsername)->delete();

            // 🌟 LOGIN PERSISTEN & REGENERASI SESSION SECARA AGRESIF
            Auth::login($user, true);
            $request->session()->regenerate();

            // Hapus penanda session register sementara setelah session login baru terbentuk
            session()->forget(['verify_username', 'email']);

            // Alihkan menggunakan path langsung agar memotong bug cache rute pada middleware auth
            return redirect('/admin')->with('success', 'Verifikasi berhasil, selamat datang di panel dashboard!');
        }

        return redirect('/register-admin')->withErrors(['username' => 'User tidak ditemukan.']);
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function checkUsername(Request $request)
    {
        $exists = \App\Models\User::where('username', $request->username)->exists();
        return response()->json(['available' => !$exists]);
    }

    public function checkEmail(Request $request)
    {
        $exists = \App\Models\User::where('email', $request->email)->exists();
        return response()->json(['available' => !$exists]);
    }
}