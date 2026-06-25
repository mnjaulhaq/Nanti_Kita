<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
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
            border-radius: 28px;
            width: 100%;
            max-width: 460px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            padding: 40px 32px;
            text-align: center;
            opacity: 0;
            transform: translateY(20px);
            animation: cardEntrance 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes cardEntrance {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        h3 {
            font-weight: 800;
            font-size: 24px;
            letter-spacing: -0.5px;
            color: #1a241f;
            margin-bottom: 8px;
        }

        .form-subtitle {
            font-size: 14px;
            color: #6a736d;
            margin-bottom: 32px;
            line-height: 1.6;
        }

        /* CONTAINER KOTAK-KOTAK OTP VISUAL */
        .otp-boxes-container {
            position: relative;
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 24px;
        }

        .otp-box {
            width: 52px;
            height: 60px;
            border: 1px solid #ced4da;
            border-radius: 14px;

            /* 🌟 UPDATE DI SINI: FONT TIDAK KAKU & RAMPING (MEDIUM) */
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 22px;
            font-weight: 500;
            color: #1a241f;

            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
            background-color: #f8f9fa;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* Efek Kotak Aktif Saat Sedang Dipilih */
        .otp-boxes-container.is-focused .otp-box.active-box {
            border-color: #243329;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(36, 51, 41, 0.15);
            transform: scale(1.02);
        }

        /* INPUTAN ASLI TERSEMBUNYI DI BELAKANG GHAIB */
        .real-otp-hidden {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            letter-spacing: 30px;
            font-size: 30px;
            z-index: 2;
        }

        .btn-primary-custom {
            background-color: #243329;
            color: #ffffff;
            border: none;
            border-radius: 14px;
            padding: 14px;
            font-weight: 600;
            font-size: 15px;
            width: 100%;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(36, 51, 41, 0.2);
        }

        .btn-primary-custom:hover {
            background-color: #141e17;
            transform: translateY(-1px);
        }

        .btn-primary-custom:active {
            transform: translateY(1px);
        }

        .custom-error-text {
            font-size: 13px;
            color: #c13515;
            font-weight: 500;
            margin-top: -12px;
            margin-bottom: 20px;
            padding: 12px;
            background-color: #fff8f6;
            border-left: 4px solid #c13515;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
            justify-content: center;
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
        <h3>Verifikasi OTP</h3>

        <p class="form-subtitle">
            Kami telah mengirimkan 6 digit kode keamanan ke <strong style="color: #2d3f34;">{{ session('email',
                'contoh@gmail.com') }}</strong>. Masukkan kodenya di bawah ini.
        </p>

        @if(session('success'))
            <div class="alert alert-success border-0 mb-4"
                style="border-radius: 12px; font-size: 14px; background-color: #eaf5ee; color: #141e17; font-weight: 500;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('otp.verify') }}" method="POST">
            @csrf

            <div class="otp-boxes-container" id="otpWrapper">
                <input type="text" name="otp_code" id="real_otp" class="real-otp-hidden" maxlength="6"
                    autocomplete="off" required pattern="\d*">

                <div class="otp-box"></div>
                <div class="otp-box"></div>
                <div class="otp-box"></div>
                <div class="otp-box"></div>
                <div class="otp-box"></div>
                <div class="otp-box"></div>
            </div>

            @error('otp_code')
                <div class="custom-error-text">
                    <span>Nama error:</span> <span>{{ $message }}</span>
                </div>
            @enderror

            <button type="submit" class="btn-primary-custom">Verifikasi Akun</button>
        </form>
    </div>

    <div class="auth-copyright">
        &copy; 2026 Admin Panel NANTIKITA. All rights reserved.
    </div>

    <script>
        const realInput = document.getElementById('real_otp');
        const visualBoxes = document.querySelectorAll('.otp-box');
        const wrapper = document.getElementById('otpWrapper');

        realInput.addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
            const values = this.value.split('');

            visualBoxes.forEach((box, index) => {
                if (values[index]) {
                    box.textContent = values[index];
                    box.classList.remove('active-box');
                } else {
                    box.textContent = '';
                    box.classList.remove('active-box');
                }
            });

            const nextIndex = values.length;
            if (nextIndex < 6) {
                visualBoxes[nextIndex].classList.add('active-box');
            }
        });

        realInput.addEventListener('focus', () => {
            wrapper.classList.add('is-focused');
            const currentLen = realInput.value.length;
            if (currentLen < 6) visualBoxes[currentLen].classList.add('active-box');
        });

        realInput.addEventListener('blur', () => {
            wrapper.classList.remove('is-focused');
            visualBoxes.forEach(box => box.classList.remove('active-box'));
        });

        window.addEventListener('DOMContentLoaded', () => {
            realInput.focus();
        });
    </script>
</body>

</html>