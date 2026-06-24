<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi OTP NantiKita</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #1c2621; padding: 30px; margin: 0; color: #ffffff;">
    <div style="max-width: 500px; margin: 0 auto; background: #25332b; padding: 30px; border-radius: 12px; border: 1px solid #2d3e35; text-align: center;">
        <h2 style="color: #6da384; margin-bottom: 5px; font-weight: bold;">NantiKita</h2>
        <p style="color: #a4b3a9; font-size: 14px; margin-top: 0;">Admin Panel Authentication</p>
        
        <hr style="border: 0; border-top: 1px solid #2d3e35; margin: 20px 0;">
        
        <p style="font-size: 16px; color: #ffffff;">Halo Admin Baru!</p>
        <p style="color: #a4b3a9; font-size: 14px; line-height: 1.5;">Berikut adalah kode OTP untuk memverifikasi pendaftaran akun kamu. Kode ini bersifat rahasia dan hanya berlaku selama <strong>5 menit</strong>.</p>
        
        <div style="margin: 30px 0;">
            <span style="font-size: 36px; font-weight: bold; letter-spacing: 6px; color: #ffffff; background: #1c2621; padding: 15px 25px; border-radius: 8px; border: 1px solid #2d3e35; display: inline-block;">
                {{ $otpCode }}
            </span>
        </div>
        
        <p style="font-size: 12px; color: #77887d; margin-top: 30px;">Jika kamu tidak merasa melakukan registrasi ini, silakan abaikan email ini.</p>
    </div>
</body>
</html>