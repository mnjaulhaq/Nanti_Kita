$(document).ready(function() {
    
    // --- 1. Parsing Nama Tamu dari Parameter URL (?to=Nama) ---
    const urlParams = new URLSearchParams(window.location.search);
    const guestName = urlParams.get('to');
    if(guestName) {
        $('#guest-name').text(guestName);
    } else {
        $('#guest-name').text('Tamu Undangan');
    }

    // --- 2. Logika Mutlak Buka Undangan (Solusi Mengatasi Stuck AOS) ---
    $('#btnOpenInvitation').on('click', function() {
        // 1. Tampilkan kontainer utama terlebih dahulu agar posisinya terbaca di DOM tree
        $('#main-content').show();
        $('#musicToggle').css('display', 'flex');
        
        // 2. Jalankan atau bangun fungsi AOS setelah display: none mati
        AOS.init({
            once: true,
            duration: 1000,
            disableMutationObserver: false
        });

        // 3. Beri sedikit jeda mikro lalu paksa refresh perhitungan piksel koordinat AOS
        setTimeout(function() {
            AOS.refresh();
        }, 100);

        // 4. Geser tabir cover utama ke atas menggunakan CSS transform
        $('#cover').css('transform', 'translateY(-100%)');
        
        // 5. Kembalikan kemampuan overflow scroll pada body halaman
        $('body').removeClass('overflow-hidden');

        // 6. Jalankan pemutaran music media player
        const music = document.getElementById('weddingMusic');
        if (music) {
            music.play().catch(function(error) {
                console.log("Autoplay ditolak oleh kebijakan keamanan browser, musik diputar manual.");
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
            $(this).css('background-color', '#c4a482');
        } else {
            music.pause();
            icon.removeClass('fa-music').addClass('fa-music-slash');
            $(this).css('background-color', '#a1887f');
        }
    });

    // --- 4. Sistem Hitung Mundur Acara (Countdown) ---
    // Target Parameter format waktu: (Tahun, Bulan 0-indexed [Jan=0, Mei=4], Hari, Jam, Menit, Detik)
    const countdownDate = new Date(2026, 4, 28, 8, 0, 0).getTime();

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
            $('.countdown').html('<h5 class="text-center text-muted w-100 py-2">Acara Sedang Berlangsung!</h5>');
        }
    }, 1000);

    // --- 5. Validasi Submit Formulir RSVP via SweetAlert2 ---
    $('#rsvpForm').on('submit', function(e) {
        e.preventDefault();
        
        const name = $('#nameInput').val();
        const status = $('#statusAttendance').val();

        Swal.fire({
          title: 'Terima Kasih!',
          text: `Konfirmasi atas nama ${name} berhasil dikirim (${status}).`,
          icon: 'success',
          confirmButtonColor: '#4a3b32',
          confirmButtonText: 'Selesai'
        });

        $('#rsvpForm')[0].reset();
    });

    // --- 6. Smooth Scroll Mobile Bottom Navbar Links ---
    $('.style-nav a').on('click', function(e) {
        if (this.hash !== "") {
            e.preventDefault();
            const hash = this.hash;
            
            $('html, body').animate({
                scrollTop: $(hash).offset().top - 20
            }, 600);
            
            $('.style-nav a').removeClass('active');
            $(this).addClass('active');
        }
    });
});