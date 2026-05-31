$(document).ready(function() {
    
    // --- 1. Get Guest Name from URL Parameter ---
    const urlParams = new URLSearchParams(window.location.search);
    const guestName = urlParams.get('to');
    if(guestName) {
        $('#guest-name').text(guestName.replace(/\+/g, " "));
    } else {
        $('#guest-name').text('Tamu Undangan');
    }

    // --- 2. Open Invitation Logic (AOS Anti-Stuck Fix) ---
    $('#btnOpenInvitation').on('click', function() {
        // Tampilkan konten utama terlebih dahulu agar posisinya terbaca di DOM tree
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
                console.log("Autoplay ditolak browser. Audio aktif setelah interaksi lanjutan.");
            });
        }
    });

    // --- 3. Music Controls Toggle (Play/Pause) ---
    $('#musicToggle').on('click', function() {
        const music = document.getElementById('weddingMusic');
        const icon = $(this).find('i');
        
        if (music.paused) {
            music.play();
            icon.removeClass('fa-play').addClass('fa-pause');
        } else {
            music.pause();
            icon.removeClass('fa-pause').addClass('fa-play');
        }
    });

    // --- 4. Wedding Countdown Target Date ---
    // Target date format: (Year, Month [0-indexed, Jan=0, Mei=4], Day, Hour, Minute)
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
            $('.countdown-modern').html('<h6 class="text-center tracking-widest w-100">THE EVENT IS CURRENTLY RUNNING</h6>');
        }
    }, 1000);

    // --- 5. RSVP Submission with SweetAlert2 ---
    $('#rsvpForm').on('submit', function(e) {
        e.preventDefault();
        
        const name = $('#nameInput').val();
        const status = $('#statusAttendance').val();

        Swal.fire({
            title: 'THANK YOU',
            text: `RSVP confirmation for "${name}" was sent successfully.`,
            icon: 'success',
            confirmButtonColor: '#111111',
            confirmButtonText: 'CLOSE'
        });

        $('#rsvpForm')[0].reset();
    });

    // --- 6. Smooth Scroll Mobile Navigation ---
    $('.style-nav-modern a').on('click', function(e) {
        if (this.hash !== "") {
            e.preventDefault();
            const hash = this.hash;
            
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 600);
            
            $('.style-nav-modern a').removeClass('active');
            $(this).addClass('active');
        }
    });
});