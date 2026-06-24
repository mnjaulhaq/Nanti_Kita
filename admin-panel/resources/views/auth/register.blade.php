<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin - NantiKita</title>
    <!-- Menggunakan Bootstrap 5 CDN untuk styling cepat -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1c2621; /* Tema gelap khas NantiKita */
            color: #ffffff;
        }
        .register-card {
            background-color: #25332b;
            border: 1px solid #2d3e35;
            border-radius: 12px;
        }
        .btn-success-custom {
            background-color: #3b5245;
            border: none;
        }
        .btn-success-custom:hover {
            background-color: #4c6a59;
        }
        .form-control:focus {
            background-color: #1c2621;
            color: #fff;
            border-color: #6da384;
            box-shadow: 0 0 0 0.25rem rgba(109, 163, 132, 0.25);
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">

    <div class="container" style="max-width: 450px;">
        <div class="card register-card p-4 shadow">
            <h3 class="text-center mb-2 fw-bold" style="color: #6da384;">NantiKita</h3>
            <p class="text-center text-muted small mb-4">Daftar Akun Admin Baru</p>

            <!-- Menampilkan Flash Message / Error jika Validasi Gagal -->
            @if ($errors->any())
                <div class="alert alert-danger small p-2">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.store') }}" method="POST">
                @csrf
                
                <!-- Input Nama Lengkap -->
                <div class="mb-3">
                    <label for="name" class="form-label small text-light">Display Name</label>
                    <input type="text" name="name" id="name" class="form-control bg-dark text-white border-secondary" value="{{ old('name') }}" required placeholder="Nama lengkap Anda">
                </div>

                <!-- Input Username -->
                <div class="mb-3">
                    <label for="username" class="form-label small text-light">Username</label>
                    <input type="text" name="username" id="username" class="form-control bg-dark text-white border-secondary" value="{{ old('username') }}" required placeholder="Username untuk login">
                </div>

                <!-- Input Email -->
                <div class="mb-3">
                    <label for="email" class="form-label small text-light">Email</label>
                    <input type="email" name="email" id="email" class="form-control bg-dark text-white border-secondary" value="{{ old('email') }}" required placeholder="Contoh: admin@gmail.com">
                </div>

                <!-- Input Password -->
                <div class="mb-3">
                    <label for="password" class="form-label small text-light">Password</label>
                    <input type="password" name="password" id="password" class="form-control bg-dark text-white border-secondary" required placeholder="Minimal 8 karakter">
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label small text-light">Password Confirmation</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control bg-dark text-white border-secondary" required placeholder="Ulangi password">
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-success-custom w-100 text-white fw-bold mb-3">Daftar & Kirim OTP</button>
                
                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-decoration-none small" style="color: #6da384;">Sudah punya akun? Login disini</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>