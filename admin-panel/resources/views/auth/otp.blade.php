<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - NantiKita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #1c2621; color: #ffffff; }
        .otp-card { background-color: #25332b; border: 1px solid #2d3e35; border-radius: 12px; }
        .btn-success-custom { background-color: #3b5245; border: none; }
        .btn-success-custom:hover { background-color: #4c6a59; }
        .form-control:focus { background-color: #1c2621; color: #fff; border-color: #6da384; box-shadow: 0 0 0 0.25rem rgba(109, 163, 132, 0.25); }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">

    <div class="container" style="max-width: 400px;">
        <div class="card otp-card p-4 shadow">
            <h3 class="text-center mb-2 fw-bold" style="color: #6da384;">Verifikasi Akun</h3>
            <p class="text-center text-muted small mb-4">Masukkan 6 digit kode OTP yang dikirim ke Gmail Anda</p>

            @if(session('success'))
                <div class="alert alert-success small p-2 text-center">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger small p-2 text-center">
                    {{ $errors->first('otp_code') }}
                </div>
            @endif

            <form action="{{ route('otp.verify') }}" method="POST">
                @csrf
                
                <input type="hidden" name="username" value="{{ session('verify_username') ?? old('username') }}">

                <div class="mb-4">
                    <label for="otp_code" class="form-label small text-light d-block text-center mb-3">Kode Verifikasi</label>
                    <input type="text" name="otp_code" id="otp_code" class="form-control text-center fw-bold fs-4 bg-dark text-white border-secondary" placeholder="000000" maxlength="6" required autocomplete="off">
                </div>

                <button type="submit" class="btn btn-success-custom w-100 text-white fw-bold mb-2">Verifikasi Akun</button>
            </form>
        </div>
    </div>

</body>
</html>