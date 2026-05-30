// 1. FUNGSI UNTUK BUKA/TUTUP TOMBOL HAMBURGER
function toggleMenu() {
  var dropdown = document.getElementById("myDropdown");
  dropdown.classList.toggle("show");
}

// 2. FUNGSI MENUTUP DROPDOWN OTOMATIS JIKA KLIK DI LUAR
window.onclick = function (e) {
  var dropdown = document.getElementById("myDropdown");

  if (dropdown && dropdown.classList.contains("show")) {
    var klikDiTombol =
      e.target.matches(".custom-hamburger-capsule") ||
      e.target.matches(".menu-icon");

    if (!klikDiTombol && !dropdown.contains(e.target)) {
      dropdown.classList.remove("show");
    }
  }
};

// 3. FUNGSI OTOMATIS MEMINDAHKAN OVAL DI MENU TENGAH (FIXED NO BLINK)
document.addEventListener("DOMContentLoaded", function () {
  const menuItems = document.querySelectorAll(".center-menu-item");
  const slider = document.querySelector(".nav-bg-slider");
  const container = document.querySelector(".navbar-center-menu");

  function moveSlider(element) {
    if (!element || !slider || !container) return;

    const targetRect = element.getBoundingClientRect();
    const containerRect = container.getBoundingClientRect();

    slider.style.width = `${targetRect.width}px`;
    slider.style.left = `${targetRect.left - containerRect.left}px`;
  }

  if (menuItems.length > 0) {
    // Matikan animasi sesaat pas web pertama kali dimuat biar ga kedip dari kiri
    slider.classList.add("no-animation");
    menuItems[0].classList.add("active");
    moveSlider(menuItems[0]);

    // Hidupkan kembali animasinya setelah layout terpasang sempurna
    setTimeout(() => {
      slider.classList.remove("no-animation");
    }, 50);
  }

  menuItems.forEach((item) => {
    item.addEventListener("click", function () {
      menuItems.forEach((menu) => menu.classList.remove("active"));
      this.classList.add("active");
      moveSlider(this);
    });
  });

  window.addEventListener("resize", () => {
    const activeItem = document.querySelector(".center-menu-item.active");
    if (activeItem) moveSlider(activeItem);
  });
});
// --- SCRIPT AUTO HOVER ON SCROLL FOR MOBILE & DESKTOP ---
const scrollTriggers = document.querySelectorAll(".scroll-trigger");

const hoverObserverOptions = {
  root: null,
  threshold: 0.5, // Efek hover aktif pas 50% boksnya masuk ke tengah layar
  rootMargin: "-10% 0px -10% 0px", // Membaca area tengah layar HP
};

const hoverObserver = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    // Cari elemen kartu asli (.price-card atau .step-card) di dalamnya
    const card = entry.target.querySelector(".price-card, .step-card");

    if (card) {
      if (entry.isIntersecting) {
        // Pas boks masuk tengah layar, nyalakan efek hover-nya otomatis!
        card.classList.add("auto-hover");
      } else {
        // Pas boks udah ke-scroll lewat atas/bawah, matikan efeknya biar kembali normal
        card.classList.remove("auto-hover");
      }
    }
  });
}, hoverObserverOptions);

// Jalankan radar pengintai scroll
scrollTriggers.forEach((el) => hoverObserver.observe(el));
