$(document).ready(function() {
    
    // --- 1. Ambil Parameter Nama Tamu dari URL (?to=Nama) ---
    const urlParams = new URLSearchParams(window.location.search);
    const guestName = urlParams.get('to');
    if(guestName) {
        $('#guest-name').text(guestName.replace(/\+/g, " "));
    } else {
        $('#guest-name').text('Tamu Undangan');
    }

    // --- 2. Logika Mutlak Buka Undangan (AOS Anti-Stuck Core Fix) ---
    $('#btnOpenInvitation').on('click', function() {
        // Tampilkan konten utama terlebih dahulu agar dimensinya dihitung oleh DOM tree
        $('#main-content').show();
        $('#musicToggle').css('display', 'flex');
        
        // Membangun ulang inisialisasi AOS setelah display kontainer induk diaktifkan
        AOS.init({
            once: true,
            duration: 1000,
            disableMutationObserver: false
        });

        // Delay mikro 100ms untuk memaksa penyegaran koordinat elemen AOS
        setTimeout(function() {
            AOS.refresh();
        }, 100);

        // Transisi geser cover overlay ke atas
        $('#cover').css('transform', 'translateY(-100%)');
        
        // Kembalikan kemampuan overflow scroll default halaman
        $('body').removeClass('overflow-hidden');

        // Play media audio player (wedding.mp3)
        const music = document.getElementById('weddingMusic');
        if (music) {
            music.play().catch(function(error) {
                console.log("Autoplay ditolak sistem keamanan browser. Audio aktif pasca interaksi lanjutan.");
            });
        }
    });

    // --- 3. Floating Player Switcher Controller (Play/Pause) ---
    $('#musicToggle').on('click', function() {
        const music = document.getElementById('weddingMusic');
        const icon = $(this).find('i');
        
        if (music.paused) {
            music.play();
            icon.removeClass('fa-music-slash').addClass('fa-music');
            $(this).css('background-color', '#3a322d');
        } else {
            music.pause();
            icon.removeClass('fa-music').addClass('fa-music-slash');
            $(this).css('background-color', '#a98467');
        }
    });

    // --- 4. Sistem Hitung Mundur Acara (Countdown) ---
    const countdownDate = new Date(2026, 4, 28, 8, 0, 0).getTime(); // Target: 28 Mei 2026

    const timer = setInterval(function() {
        const now = new Date().getTime();
        const distance = countdownDate - now;

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        $('#days').text(days < 10 ? '0' + days : days);
        $('#hours').text(hours < 10 ? '0' + hours : hours);
        $('#minutes').text(minutes < 10 ? '0' + minutes : minutes);
        $('#seconds').text(seconds < 10 ? '0' + seconds : seconds);

        if (distance < 0) {
            clearInterval(timer);
            $('.countdown-japandi').html('<h6 class="text-center tracking-widest w-100 py-2">ACARA SEDANG BERLANGSUNG</h6>');
        }
    }, 1000);

    // --- 5. Validasi Submit Formulir RSVP via SweetAlert2 ---
    $('#rsvpForm').on('submit', function(e) {
        e.preventDefault();
        
        const name = $('#nameInput').val();
        const status = $('#statusAttendance').val();

        Swal.fire({
            title: 'TERIMA KASIH',
            text: `Konfirmasi kehadiran atas nama "${name}" berhasil dikirim.`,
            icon: 'success',
            confirmButtonColor: '#3a322d',
            confirmButtonText: 'TUTUP'
        });

        $('#rsvpForm')[0].reset();
    });

    // --- 6. Smooth Scroll Mobile Bottom Navbar Links ---
    $('.style-nav-japandi a').on('click', function(e) {
        if (this.hash !== "") {
            e.preventDefault();
            const hash = this.hash;
            
            $('html, body').animate({
                scrollTop: $(hash).offset().top - 20
            }, 600);
            
            $('.style-nav-japandi a').removeClass('active');
            $(this).addClass('active');
        }
    });
});