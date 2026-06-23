function bukaUndangan() {
  $("#opening").addClass("hide");
  const music = document.getElementById("bgMusic");
  music.volume = 0.5;
  music.play().then(() => {
    $("#musicControl").addClass("active");
  });

  AOS.init({
    duration: 1000,
    once: true,
  });
}

window.addEventListener("DOMContentLoaded", () => {
  const music = document.getElementById("bgMusic");
  const musicBtn = document.getElementById("musicControl");
  musicBtn.addEventListener("click", () => {
    if (music.paused) {
      music.play();
    } else {
      music.pause();
    }
  });
});

// Countdown Target
const targetDate = new Date(2026, 7, 8, 9, 0, 0).getTime();
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

document.addEventListener("DOMContentLoaded", () => {
  const urlParams = new URLSearchParams(window.location.search);
  const namaTamu = urlParams.get("to");
  document.getElementById("guest-name").innerText = namaTamu
    ? namaTamu.replace(/\+/g, " ")
    : "Tamu Undangan";
});
