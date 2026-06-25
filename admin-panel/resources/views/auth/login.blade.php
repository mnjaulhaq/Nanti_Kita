<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            position: relative;
            background-color: #141e17;
            /* Efek garis grid kotak samar */
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.018) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.018) 1px, transparent 1px),
                linear-gradient(135deg, #141e17 0%, #243329 100%);
            /* Warna dasarmu */
            background-size: 32px 32px, 32px 32px, auto;
            min-height: 100vh;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            /* Font bawaanmu */
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .form-card {
            background-color: #ffffff;
            border-radius: 24px;
            /* Disamakan 24px dengan register */
            width: 100%;
            max-width: 560px;
            /* Lebar maksimal disamakan dengan register */
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.25);
            color: #222222;
            opacity: 0;
            transform: translateY(30px);
            animation: cardEntrance 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1),
                box-shadow 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .form-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 24px 56px rgba(0, 0, 0, 0.35);
        }

        @keyframes cardEntrance {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* 🌟 Samakan Padding Header dengan Register yang baru */
        .form-card-header {
            padding: 32px 32px 0px 32px;
            border-bottom: none !important;
            text-align: center;
        }

        .form-card-header h3 {
            font-weight: 800;
            font-size: 24px;
            color: #222222;
            margin: 0;
            letter-spacing: -0.5px;
        }

        /* 🌟 Samakan Spacing Subtitle dengan Register yang baru */
        .form-subtitle {
            font-size: 15px;
            color: #717171;
            margin-bottom: 20px;
            font-weight: 400;
            text-align: center;
            margin-top: 4px;
        }

        /* 🌟 Samakan Padding Body dengan Register yang baru */
        .form-card-body {
            padding: 16px 32px 32px 32px;
        }

        .custom-floating-field {
            border: 1px solid #b0b0b0;
            border-radius: 12px;
            overflow: hidden;
            background-color: #ffffff;
            transition: all 0.3s ease;
            position: relative;
            height: 56px;
            margin-bottom: 4px;
        }

        .custom-floating-field:focus-within {
            border: 2px solid #2d3f34 !important;
            box-shadow: 0 0 0 4px rgba(45, 63, 52, 0.12);
        }

        .custom-floating-field.is-invalid-border {
            border-color: #c13515 !important;
            box-shadow: 0 0 0 4px rgba(193, 53, 21, 0.1) !important;
        }

        .custom-floating-field input {
            width: 100%;
            height: 100%;
            border: none;
            padding: 26px 16px 10px 16px !important;
            margin-top: 0px;
            margin-left: 0px;
            font-size: 15px;
            color: #1a241f !important;
            outline: none;
            background: transparent !important;
            box-shadow: none !important;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .custom-floating-field label {
            position: absolute;
            left: 16px;
            top: 18px;
            font-size: 15px;
            color: #717171;
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), font-size 0.3s ease, color 0.3s ease;
            pointer-events: none;
            transform-origin: top left;
        }

        .custom-floating-field input:focus~label,
        .custom-floating-field input:not(:placeholder-shown)~label {
            transform: translateY(-12px) scale(0.75);
            font-weight: 700;
            color: #222222;
        }

        .btn-primary-custom {
            background-color: #2d3f34;
            color: #ffffff;
            border: none;
            border-radius: 14px;
            padding: 12px 24px;
            font-weight: 600;
            font-size: 15px;
            width: 100%;
            transition: background-color 0.3s ease, transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            margin-top: 16px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .btn-primary-custom:hover {
            background-color: #1e2d24;
        }

        .btn-primary-custom:active {
            transform: scale(0.93);
        }

        .link-footer {
            color: #222222;
            text-decoration: underline;
            font-size: 14px;
            font-weight: 600;
            display: inline-block;
            margin-top: 24px;
            transition: color 0.2s;
        }

        .link-footer:hover {
            color: #222222;
        }

        .field-error-text {
            font-size: 13px;
            color: #c13515;
            font-weight: 500;
            margin-top: 10px;
            margin-bottom: 12px;
            padding: 10px 14px;
            background-color: #fff8f6;
            border-left: 3px solid #c13515;
            border-radius: 4px;
            display: flex;
            align-items: center;
            gap: 6px;
            animation: luxuryFadeIn 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes luxuryFadeIn {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .auth-copyright {
            position: absolute;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%);
            color: rgba(255, 255, 255, 0.35);
            /* Warna putih transparan agar menyatu dengan grid */
            font-size: 13px;
            font-weight: 500;
            letter-spacing: 0.3px;
            text-align: center;
            width: 100%;
            pointer-events: none;
            font-family: 'Plus Jakarta Sans', sans-serif;

            /* Animasi fade-in halus mengikuti kartunya */
            opacity: 0;
            animation: copyrightFadeIn 1.2s ease forwards 0.3s;
        }

        @keyframes copyrightFadeIn {
            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body>

    <div class="form-card">
        <!-- 🌟 Menggunakan Struktur Header Kembar dengan Register -->
        <div class="form-card-header">
            <h3>Log In to Admin Panel</h3>
            <p class="form-subtitle">Please enter your account details</p>
        </div>

        <div class="form-card-body">
            <form action="{{ route('login') }}" method="POST" id="loginForm" novalidate>
                @csrf

                <div class="custom-floating-field" id="username_container">
                    <input type="text" name="username" id="username" value="{{ old('username') }}" placeholder=" ">
                    <label for="username">Username</label>
                </div>
                <div class="field-error-text" id="error_username" style="display: none;">
                    <span>⚠️</span> <span class="err-msg"></span>
                </div>

                <div style="height: 12px;" id="spacer_gap"></div>

                <div class="custom-floating-field" id="password_container">
                    <input type="password" name="password" id="password" placeholder=" ">
                    <label for="password">Password</label>
                </div>
                <div class="field-error-text" id="error_password" style="display: none;">
                    <span>⚠️</span> <span class="err-msg"></span>
                </div>

                @if($errors->any())
                    <div class="field-error-text" id="backend_general_error">
                        <span>⚠️</span> <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <button type="submit" class="btn-primary-custom">Log In</button>

                <div class="text-center">
                    <a href="{{ route('register') }}" class="link-footer">Belum punya akun? Daftar Admin</a>
                </div>
            </form>
        </div>
    </div>

    <div class="auth-copyright">
        &copy; 2026 Admin Panel NANTIKITA. All rights reserved.
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function (event) {
            const usernameInput = document.getElementById('username');
            const passwordInput = document.getElementById('password');

            const usernameContainer = document.getElementById('username_container');
            const passwordContainer = document.getElementById('password_container');

            const errorUsername = document.getElementById('error_username');
            const errorPassword = document.getElementById('error_password');

            const backendGeneralError = document.getElementById('backend_general_error');

            let isFormValid = true;

            errorUsername.style.display = 'none';
            errorPassword.style.display = 'none';
            usernameContainer.classList.remove('is-invalid-border');
            passwordContainer.classList.remove('is-invalid-border');
            if (backendGeneralError) backendGeneralError.style.display = 'none';

            if (!usernameInput.value.trim()) {
                usernameContainer.classList.add('is-invalid-border');
                errorUsername.querySelector('.err-msg').innerText = "Username wajib diisi, tidak boleh kosong.";
                errorUsername.style.display = 'flex';
                isFormValid = false;
            }

            if (!passwordInput.value.trim()) {
                passwordContainer.classList.add('is-invalid-border');
                errorPassword.querySelector('.err-msg').innerText = "Password wajib diisi, tidak boleh kosong.";
                errorPassword.style.display = 'flex';
                isFormValid = false;
            }

            if (!isFormValid) {
                event.preventDefault();
            }
        });

        document.getElementById('username').addEventListener('input', function () {
            document.getElementById('username_container').classList.remove('is-invalid-border');
            document.getElementById('error_username').style.display = 'none';
        });
        document.getElementById('password').addEventListener('input', function () {
            document.getElementById('password_container').classList.remove('is-invalid-border');
            document.getElementById('error_password').style.display = 'none';
        });
    </script>
</body>

</html>