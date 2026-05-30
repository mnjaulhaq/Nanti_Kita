function toggleMenu() {
  var dropdown = document.getElementById("myDropdown");
  dropdown.classList.toggle("show");
}

// Opsional: Klik di luar menu buat nutup dropdown otomatis
window.onclick = function(e) {
  var dropdown = document.getElementById("myDropdown");
  
  // Pastikan dropdown-nya ada dan lagi kebuka (.show)
  if (dropdown && dropdown.classList.contains('show')) {
    // Jika yang diklik BUKAN tombol hamburger dan BUKAN ikon garis tiganya, maka tutup
    if (!e.target.matches('.custom-hamburger') && !e.target.matches('.navbar-toggler-icon')) {
      dropdown.classList.remove('show');
    }
  }
}