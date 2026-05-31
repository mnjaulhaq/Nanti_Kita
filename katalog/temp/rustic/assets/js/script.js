// Konfigurasi Utama
const scriptURL =
  "https://script.google.com/macros/s/AKfycbxQw_uRJ7XizCBGt3YUCDptEpfVHbiapdfgb-wMnJT_4oWlQFND8veZCYT98rXyMNDAeg/exec";

AOS.init({
  duration: 1000,
  once: false,
  easing: "ease",
  mirror: false,
  offset: 120,
});

// UX: Smooth Opening
// 5. FUNGSI UI & UX LAINNYA
function bukaUndangan() {
  $("#opening").addClass("hide");
  const music = document.getElementById("bgMusic");
  music.volume = 0.5;
  music.play().then(() => {
    $("#musicControl").addClass("active");
  });
}

// Active Nav optimized
let scrollTimeout;
$(window).on("scroll", function () {
  clearTimeout(scrollTimeout);
  scrollTimeout = setTimeout(function () {
    let scrollDistance = $(window).scrollTop();
    $("section").each(function (i) {
      if ($(this).position().top <= scrollDistance + 200) {
        $("#mainNav a.active").removeClass("active");
        $("#mainNav a").eq(i).addClass("active");
      }
    });
  }, 100);
});

// --- FUNGSI LOAD DATA (Ambil Ucapan) ---
function loadUcapan() {
  fetch(scriptURL)
    .then((response) => response.json())
    .then((data) => {
      let html = "";
      if (data.length === 0) {
        html =
          '<p class="text-center text-muted small py-4">Belum ada ucapan.</p>';
      } else {
        data.reverse().forEach((row) => {
          html += `
            <div class="border-bottom py-3 ucapan-item">
                <p class="mb-1 fw-bold text-dark small">${row.nama}</p>
                <p class="small text-muted mb-0">"${row.pesan}"</p>
            </div>`;
        });
      }

      // PROSES TRANSISI HALUS
      const container = $("#display-ucapan");

      // 1. Sembunyikan container dengan halus
      container.fadeOut(400, function () {
        // 2. Ganti loading spinner dengan data asli saat container gak kelihatan
        container.html(html);
        // 3. Munculkan kembali pelan-pelan
        container.fadeIn(600);
      });
    })
    .catch((error) => {
      console.error("Gagal:", error);
      $("#display-ucapan").html(
        '<p class="text-center text-danger small">Gagal memuat ucapan.</p>',
      );
    });
}

// --- FUNGSI KIRIM DATA ---
// ini simulasi biar datanya ga ke kirim
$("#btnKirim").on("click", function () {
  const nama = $("#nama").val();
  const pesan = $("#pesan").val();

  if (nama && pesan) {
    Swal.fire({
      title: "Mengirim (Mode Tes)...",
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading();
      },
    });

    // =========================================================================
    // TRICK: MATIKAN FETCH LIVE, GANTI PAKAI SETTIMEOUT BIAR SEOLAH-OLAH PROSES
    // =========================================================================
    setTimeout(() => {
      Swal.fire({
        title: "Terkirim (Mode Tes)!",
        text: "Ucapan tersimpan di layar local saja (Aman dari Google Sheets).",
        icon: "success",
        confirmButtonColor: "#b8916a",
      });

      // Tetap update tampilan di web biar aa bisa liat animasinya
      const item = `
        <div class="border-bottom py-3">
            <p class="mb-1 fw-bold text-dark small">${nama}</p>
            <p class="small text-muted mb-0">"${pesan}"</p>
        </div>`;
      $(item).prependTo("#display-ucapan").hide().fadeIn(1000);

      $("#nama").val("");
      $("#pesan").val("");
    }, 1000); // Simulasi delay loading 1 detik
  } else {
    Swal.fire("Oops!", "Isi nama dan ucapan dulu a.", "error");
  }
});

// Countdown Logic
const targetDate = new Date(2026, 5, 6, 8, 0, 0).getTime();
setInterval(function () {
  const now = new Date().getTime();
  const distance = targetDate - now;
  if (distance > 0) {
    document.getElementById("days").innerHTML = Math.floor(
      distance / (1000 * 60 * 60 * 24),
    );
    document.getElementById("hours").innerHTML = Math.floor(
      (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60),
    );
    document.getElementById("minutes").innerHTML = Math.floor(
      (distance % (1000 * 60 * 60)) / (1000 * 60),
    );
    document.getElementById("seconds").innerHTML = Math.floor(
      (distance % (1000 * 60)) / 1000,
    );
  }
}, 1000);

// Music Control
window.addEventListener("DOMContentLoaded", () => {
  const music = document.getElementById("bgMusic");
  const musicBtn = document.getElementById("musicControl");

  musicBtn.addEventListener("click", () => {
    if (music.paused) {
      music.play();
      musicBtn.classList.add("active");
    } else {
      music.pause();
      musicBtn.classList.remove("active");
    }
  });
});

// Copy Rekening
function copyText(text) {
  navigator.clipboard.writeText(text);

  Swal.fire({
    title: "Berhasil!",
    text: "Nomor berhasil disalin",
    icon: "success",
    timer: 1500,
    showConfirmButton: false,
  });
}

// 6. JALANKAN SAAT LOAD
document.addEventListener("DOMContentLoaded", () => {
  loadUcapan();
  const urlParams = new URLSearchParams(window.location.search);
  const namaTamu = urlParams.get("to");

  if (namaTamu) {
    document.getElementById("guest-name").innerText = namaTamu.replace(
      /\+/g,
      " ",
    );
  } else {
    document.getElementById("guest-name").innerText = "Tamu Undangan";
  }
});
