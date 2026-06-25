<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>
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
            width: 100%;
            max-width: 560px;
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.25);
            color: #222222;
            height: auto;
            transform: translateY(30px);
            opacity: 0;
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

        .shake-bounce {
            animation: luxuryInputShake 0.45s cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
            border-color: #c13515 !important;
            box-shadow: 0 0 0 4px rgba(193, 53, 21, 0.1) !important;
        }

        @keyframes luxuryInputShake {

            10%,
            90% {
                transform: translate3d(-3px, 0, 0);
            }

            20%,
            80% {
                transform: translate3d(5px, 0, 0);
            }

            30%,
            50%,
            70% {
                transform: translate3d(-6px, 0, 0);
            }

            40%,
            60% {
                transform: translate3d(6px, 0, 0);
            }
        }

        /* 🌟 FIX: Garis bawah header dibuang murni */
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

        .form-card-body {
            padding: 16px 32px 32px 32px;
        }

        .form-subtitle {
            font-size: 15px;
            color: #717171;
            margin-bottom: 20px;
            font-weight: 400;
            text-align: center;
        }

        .step-input-group {
            border: 1px solid #b0b0b0;
            border-radius: 12px;
            overflow: hidden;
            background-color: #ffffff;
            margin-bottom: 16px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .step-input-group:hover {
            border-color: #222222;
        }

        /* 🌟 Set Container Field agar Selaras dengan Layout Login */
        .step-input-wrapper {
            position: relative;
            background-color: #ffffff;
            transition: all 0.3s ease;
            height: 56px;
            box-sizing: border-box;
        }

        .step-input-wrapper:not(:last-child) {
            border-bottom: 1px solid #ebebeb;
        }

        .step-input-wrapper label {
            position: absolute;
            top: 18px;
            left: 16px;
            font-size: 15px;
            font-weight: 400;
            color: #717171;
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), font-size 0.3s ease, color 0.3s ease;
            pointer-events: none;
            transform-origin: top left;
        }

        /* 🌟 FIX UTAMA: Menambahkan reset rule input global khusus register */
        .step-input-wrapper .form-control {
            border: none !important;
            border-radius: 0px !important;
            width: 100%;
            height: 100% !important;
            padding: 26px 16px 10px 16px !important;
            margin-top: 0px !important;
            margin-left: 0px !important;
            box-sizing: border-box;
            font-size: 15px;
            color: #222222 !important;
            background-color: transparent !important;
            box-shadow: none !important;
            outline: none !important;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .step-input-wrapper .form-control::placeholder {
            color: transparent;
        }

        .step-input-wrapper .form-control:focus~label,
        .step-input-wrapper .form-control:not(:placeholder-shown)~label {
            transform: translateY(-12px) scale(0.75);
            font-weight: 700;
            color: #222222;
        }

        /* 🌟 Trick Khusus menjinakkan kotak warna Autofill Google Chrome */
        .step-input-wrapper .form-control:-webkit-autofill,
        .step-input-wrapper .form-control:-webkit-autofill:hover,
        .step-input-wrapper .form-control:-webkit-autofill:focus {
            -webkit-text-fill-color: #222222 !important;
            -webkit-box-shadow: 0 0 0px 1000px #ffffff inset !important;
        }

        .step-input-group:focus-within {
            border: 2px solid #2d3f34 !important;
            margin-top: -1px;
            margin-bottom: 16px;
            box-shadow: 0 0 0 4px rgba(45, 63, 52, 0.12);
        }

        .btn-primary-custom {
            background-color: #2d3f34;
            color: #ffffff;
            border: none;
            border-radius: 14px;
            padding: 12px 24px;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .btn-primary-custom:hover {
            background-color: #1e2d24;
        }

        .btn-primary-custom:active {
            transform: scale(0.93);
        }

        .btn-link-back {
            background: none;
            border: none;
            color: #717171;
            font-size: 15px;
            font-weight: 600;
            text-decoration: underline;
            padding: 0;
            transition: color 0.2s ease;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .btn-link-back:hover {
            color: #222222;
        }

        .link-footer {
            color: #222222;
            text-decoration: underline;
            font-size: 14px;
            font-weight: 600;
        }

        .custom-error-text {
            font-size: 13px;
            color: #c13515;
            font-weight: 500;
            margin-top: 10px;
            margin-bottom: 12px;
            padding: 10px 14px;
            background-color: #fff8f6;
            border-left: 3px solid #c13515;
            border-radius: 4px;
            display: none;
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

        .step-panel {
            display: none;
            animation: luxuryStepIn 0.9s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .step-panel.active {
            display: block;
        }

        @keyframes luxuryStepIn {
            from {
                opacity: 0;
                transform: translate3d(24px, 0, 0);
            }

            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }

        #loading-panel {
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 200px;
            width: 100%;
        }

        .dots-container {
            display: flex;
            gap: 6px;
        }

        .dot {
            width: 10px;
            height: 10px;
            background-color: #222222;
            border-radius: 50%;
            animation: bounceDots 0.6s infinite alternate;
        }

        .dot:nth-child(2) {
            animation-delay: 0.15s;
        }

        .dot:nth-child(3) {
            animation-delay: 0.3s;
        }

        @keyframes bounceDots {
            from {
                opacity: 0.3;
                transform: translateY(0);
            }

            to {
                opacity: 1;
                transform: translateY(-10px);
            }
        }

        /* 🌟 FIX: Memaksa area tombol bersih dari segala border melintang */
        .action-footer-wrapper {
            border-top: none !important;
            box-shadow: none !important;
            outline: none !important;
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

    <div class="form-card" id="mainCard">
        <div class="form-card-header">
            <h3>Daftar Akun Admin</h3>
        </div>

        <div class="form-card-body">
            <form id="regForm" action="{{ route('register.store') }}" method="POST" onsubmit="return false;">
                @csrf

                <div class="step-panel active" id="step-1">
                    <p class="form-subtitle">Silakan tentukan username unik Anda untuk mengakses panel.</p>
                    <div class="step-input-group">
                        <div class="step-input-wrapper">
                            <input type="text" name="username" id="username" class="form-control"
                                value="{{ old('username') }}" required placeholder=" " autocomplete="off">
                            <label for="username">Username</label>
                        </div>
                    </div>
                    <div class="custom-error-text" id="error-username" @if($errors->has('username'))
                    style="display:flex;" @endif>
                        <span>⚠️</span> <span class="error-msg">@if($errors->has('username'))
                        {{ $errors->first('username') }} @else Username wajib diisi, tidak boleh kosong.
                            @endif</span>
                    </div>
                </div>

                <div class="step-panel" id="step-2">
                    <p class="form-subtitle">Kami akan mengirimkan 6 digit kode keamanan ke alamat email ini.</p>
                    <div class="step-input-group">
                        <div class="step-input-wrapper">
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
                                required placeholder=" " autocomplete="off">
                            <label for="email">Alamat Email</label>
                        </div>
                    </div>
                    <div class="custom-error-text" id="error-email" @if($errors->has('email')) style="display:flex;"
                    @endif>
                        <span>⚠️</span> <span class="error-msg">@if($errors->has('email')) {{ $errors->first('email') }}
                        @else Alamat email wajib diisi dengan benar. @endif</span>
                    </div>
                </div>

                <div class="step-panel" id="step-3">
                    <p class="form-subtitle">Gunakan kombinasi kata sandi yang kuat dan aman.</p>
                    <div class="step-input-group">
                        <div class="step-input-wrapper">
                            <input type="password" name="password" id="password" class="form-control" required
                                placeholder=" ">
                            <label for="password">Kata Sandi</label>
                        </div>
                        <div class="step-input-wrapper">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" required placeholder=" ">
                            <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                        </div>
                    </div>
                    <div class="custom-error-text" id="error-password" @if($errors->has('password'))
                    style="display:flex;" @endif>
                        <span>⚠️</span> <span class="error-msg">@if($errors->has('password'))
                        {{ $errors->first('password') }} @else Kata sandi tidak boleh kosong. @endif</span>
                    </div>
                </div>

                <div class="step-panel" id="step-4">
                    <p class="form-subtitle">Bagaimana kami harus memanggil nama Anda di sistem dashboard?</p>
                    <div class="step-input-group">
                        <div class="step-input-wrapper">
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                                required placeholder=" " autocomplete="off">
                            <label for="name">Display Name</label>
                        </div>
                    </div>
                    <div class="custom-error-text" id="error-name" @if($errors->has('name')) style="display:flex;"
                    @endif>
                        <span>⚠️</span> <span class="error-msg">@if($errors->has('name')) {{ $errors->first('name') }}
                        @else Display name wajib diisi. @endif</span>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between mt-5 pt-2 action-footer-wrapper">
                    <div id="left-action">
                        <a href="{{ route('login') }}" class="link-footer" id="login-link">Sudah punya akun? Masuk</a>
                        <button type="button" class="btn-link-back d-none" id="btn-back"
                            onclick="navigateStep(-1)">Kembali</button>
                    </div>
                    <button type="button" class="btn-primary-custom" id="btn-next"
                        onclick="navigateStep(1)">Berikutnya</button>
                </div>
            </form>

            <div id="loading-panel">
                <div class="dots-container">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="auth-copyright">
        &copy; 2026 Admin Panel NANTIKITA. All rights reserved.
    </div>

    <script>
        let currentStep = 1;
        const totalSteps = 4;
        const baseTitle = "Register Admin";
        const baseUrl = window.location.pathname;
        const cardEl = document.getElementById('mainCard');

        // 1. VALIDASI FORMAT DASAR FRONT-END (INSTAN SAAT KETIK / BLUR)
        function validateField(inputEl) {
            const inputGroup = inputEl.closest('.step-input-group');
            const currentPanel = inputEl.closest('.step-panel');
            const errorDiv = currentPanel.querySelector('.custom-error-text');
            const msgSpan = errorDiv ? errorDiv.querySelector('.error-msg') : null;

            let isValid = true;
            let errorMessage = "";

            if (!inputEl.value.trim()) {
                isValid = false;
                if (inputEl.id === 'username') errorMessage = "Username wajib diisi, tidak boleh kosong.";
                if (inputEl.id === 'email') errorMessage = "Alamat email wajib diisi dengan benar.";
                if (inputEl.id === 'password') errorMessage = "Kata sandi tidak boleh kosong.";
                if (inputEl.id === 'name') errorMessage = "Display name wajib diisi.";
            } else {
                if (inputEl.id === 'username') {
                    const usernameRegex = /^[a-zA-Z][a-zA-Z0-9._-]*$/;
                    if (!usernameRegex.test(inputEl.value.trim())) {
                        errorMessage = "Username harus diawali dengan huruf dan tidak boleh hanya berisi simbol.";
                        isValid = false;
                    } else if (inputEl.value.trim().length < 5) {
                        errorMessage = "Username minimal harus 5 karakter.";
                        isValid = false;
                    }
                }

                if (inputEl.id === 'email') {
                    if (!inputEl.checkValidity()) {
                        errorMessage = "Alamat email wajib diisi dengan benar.";
                        isValid = false;
                    }
                }

                if (inputEl.id === 'password' || inputEl.id === 'password_confirmation') {
                    const passwordVal = document.getElementById('password').value;
                    const passwordConfirmVal = document.getElementById('password_confirmation').value;

                    if (passwordVal.length < 8) {
                        errorMessage = "Kata sandi minimal harus 8 karakter.";
                        isValid = false;
                    } else if (passwordConfirmVal && passwordVal !== passwordConfirmVal) {
                        errorMessage = "Konfirmasi kata sandi tidak cocok, pastikan kombinasi hurufnya sama.";
                        isValid = false;
                    }
                }

                if (inputEl.id === 'name') {
                    const nameRegex = /^[a-zA-Z][a-zA-Z0-9\s]*$/;
                    if (!nameRegex.test(inputEl.value.trim())) {
                        errorMessage = "Display name harus diawali dengan huruf dan tidak boleh mengandung simbol atau angka di awal.";
                        isValid = false;
                    }
                }
            }

            if (!isValid) {
                if (errorDiv && msgSpan) {
                    msgSpan.innerText = errorMessage;
                    errorDiv.style.display = 'flex';
                }
            } else {
                if (errorDiv) errorDiv.style.display = 'none';
                if (inputGroup) inputGroup.classList.remove('shake-bounce');
            }

            return isValid;
        }

        // Pasang listener ketik ulang langsung hapus efek error merah
        document.querySelectorAll('#regForm input').forEach(input => {
            input.addEventListener('input', function () { validateField(this); });
            input.addEventListener('blur', function () { validateField(this); });
            input.addEventListener('keydown', function (event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    navigateStep(1);
                }
            });
        });

        // 2. FUNGSI TOMBOL NAVIGASI UTAMA + ASYNC VALIDASI DATABASE
        async function navigateStep(direction, isFromPopState = false) {
            if (direction === 1) {
                const currentPanel = document.getElementById(`step-${currentStep}`);
                const currentInputs = currentPanel.querySelectorAll('input');
                const errorDiv = currentPanel.querySelector('.custom-error-text');
                const inputGroup = currentPanel.querySelector('.step-input-group');
                let stepValid = true;

                // A. Cek validasi format dasarnya dulu
                currentInputs.forEach(input => {
                    if (!validateField(input)) stepValid = false;
                });

                if (!stepValid) {
                    if (inputGroup) { void inputGroup.offsetWidth; inputGroup.classList.add('shake-bounce'); }
                    return;
                }

                // B. 🌟 CEK DATABASE LANGSUNG PAS KLIK "BERIKUTNYA"
                if (currentStep === 1) {
                    const usernameInput = document.getElementById('username');
                    try {
                        let response = await fetch("{{ route('register.checkUsername') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({ username: usernameInput.value.trim() })
                        });
                        let data = await response.json();
                        if (!data.available) {
                            if (errorDiv) {
                                errorDiv.querySelector('.error-msg').innerText = "Username sudah terdaftar.";
                                errorDiv.style.display = 'flex';
                            }
                            if (inputGroup) { void inputGroup.offsetWidth; inputGroup.classList.add('shake-bounce'); }
                            return; // Blokir, jangan biarkan pindah step
                        }
                    } catch (err) { console.error(err); }
                }

                if (currentStep === 2) {
                    const emailInput = document.getElementById('email');
                    try {
                        let response = await fetch("{{ route('register.checkEmail') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({ email: emailInput.value.trim() })
                        });
                        let data = await response.json();
                        if (!data.available) {
                            if (errorDiv) {
                                errorDiv.querySelector('.error-msg').innerText = "Email sudah digunakan akun lain.";
                                errorDiv.style.display = 'flex';
                            }
                            if (inputGroup) { void inputGroup.offsetWidth; inputGroup.classList.add('shake-bounce'); }
                            return; // Blokir, jangan biarkan pindah step
                        }
                    } catch (err) { console.error(err); }
                }
            }

            // Jalankan transisi perpindahan halaman jika lolos pengecekan
            document.getElementById(`step-${currentStep}`).classList.remove('active');
            currentStep += direction;

            if (currentStep > totalSteps) {
                document.querySelector('.form-card-header').style.display = 'none';
                const form = document.getElementById('regForm');
                form.removeAttribute('onsubmit');
                form.style.display = 'none';
                document.querySelector('.d-flex.align-items-center.justify-content-between').style.display = 'none';
                document.getElementById('loading-panel').style.display = 'flex';
                form.submit();
                return;
            }

            document.getElementById(`step-${currentStep}`).classList.add('active');

            if (!isFromPopState) {
                history.pushState({ step: currentStep }, `${baseTitle} - Step ${currentStep}`, `${baseUrl}?step=${currentStep}`);
            }

            if (currentStep === 1) {
                document.getElementById('login-link').classList.remove('d-none');
                document.getElementById('btn-back').classList.add('d-none');
                document.getElementById('btn-next').innerText = "Berikutnya";
            } else {
                document.getElementById('login-link').classList.add('d-none');
                document.getElementById('btn-back').classList.remove('d-none');
                document.getElementById('btn-next').innerText = currentStep === totalSteps ? "Daftar Akun" : "Berikutnya";
            }
        }

        window.addEventListener('popstate', function (event) {
            if (event.state && event.state.step) {
                let targetStep = event.state.step;
                let stepDiff = targetStep - currentStep;
                navigateStep(stepDiff, true);
            } else if (currentStep > 1) {
                navigateStep(-1, true);
            }
        });

        history.replaceState({ step: 1 }, `${baseTitle} - Step 1`, `${baseUrl}?step=1`);

        @if ($errors->has('username'))
            // Stay 1
        @elseif ($errors->has('email'))
            document.getElementById('error-email').style.display = 'flex';
            navigateStep(1);
        @elseif ($errors->has('password'))
            document.getElementById('error-password').style.display = 'flex';
            navigateStep(1); navigateStep(1);
        @endif
    </script>
</body>

</html>