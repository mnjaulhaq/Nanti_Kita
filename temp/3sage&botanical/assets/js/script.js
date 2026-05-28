AOS.init({ duration: 1000, once: true });

// UX: Smooth Opening
function bukaUndangan() {
  $("#opening").addClass("hide");

  const music = document.getElementById("bgMusic");

  music.volume = 0.5;

  // paksa play setelah interaksi user
  let playPromise = music.play();

  if (playPromise !== undefined) {
    playPromise
      .then(() => {
        $("#musicControl").addClass("active");
      })
      .catch((error) => {
        console.log("Audio gagal diputar:", error);
      });
  }
}

// UX: Active Nav on Scroll
$(window)
  .scroll(function () {
    var scrollDistance = $(window).scrollTop();
    $("section").each(function (i) {
      if ($(this).position().top <= scrollDistance + 150) {
        $("#mainNav a.active").removeClass("active");
        $("#mainNav a").eq(i).addClass("active");
      }
    });
  })
  .scroll();

// UI: Handle Kirim Ucapan with SweetAlert2
$("#btnKirim").on("click", function () {
  const nama = $("#nama").val();
  const pesan = $("#pesan").val();

  if (nama && pesan) {
    const item = `
                    <div class="border-bottom py-3" style="display:none">
                        <p class="mb-1 fw-bold text-dark small">${nama}</p>
                        <p class="small text-muted mb-0">"${pesan}"</p>
                    </div>`;

    $(item).prependTo("#display-ucapan").fadeIn(1000);
    $("#nama").val("");
    $("#pesan").val("");

    Swal.fire({
      title: "Terkirim!",
      text: "Terima kasih atas doa restunya.",
      icon: "success",
      confirmButtonColor: "#b8916a",
    });
  } else {
    Swal.fire({
      title: "Oops!",
      text: "Tolong isi nama dan ucapan Anda.",
      icon: "error",
      confirmButtonColor: "#b8916a",
    });
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