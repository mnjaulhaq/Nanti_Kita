<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nanti Kita - Premium Digital Invitation</title>
  
  <!-- CSS Bootstrap 5.3.3 & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  
  <!-- Google Fonts: Kombinasi Serif Mewah & Sans-Serif Bersih -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700&family=Montserrat:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,600;1,400&display=swap" rel="stylesheet">

  <style>
    :root {
        --bg-color: #FBF9F6;       /* Warna dasar cream lembut */
        --dark-text: #2A2A2A;      /* Warna teks utama (Charcoal) */
        --accent-gold: #D4AF37;    /* Warna aksen emas */
        --btn-premium: #8C6A5E;    /* Dusty Rose untuk tombol premium */
    }

    body {
        background-color: var(--bg-color);
        font-family: 'Montserrat', sans-serif;
        color: var(--dark-text);
    }

    /* --- NAVBAR BRANDING "NANTI KITA" --- */
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        padding: 15px 40px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }
    .navbar-brand-text {
        font-family: 'Cinzel', serif;
        font-weight: 700;
        font-size: 1.4rem;
        letter-spacing: 3px;
        color: var(--dark-text);
        text-decoration: none;
        text-transform: uppercase;
    }
    .item {
        font-family: 'Montserrat', sans-serif;
        font-weight: 500;
        font-size: 0.9rem;
        color: var(--dark-text);
        text-decoration: none;
        padding: 10px 20px;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: all 0.3s ease;
    }
    .item-bi {
        color: var(--dark-text);
        padding: 10px;
        font-size: 1.1rem;
        transition: color 0.3s ease;
    }
    .item:hover, .item-bi:hover {
        color: var(--accent-gold);
        text-decoration: none;
    }
    
    @media (max-width: 767px) {
        .top-item {
            border-top: 1px solid rgba(0,0,0,0.05);
            margin-top: 10px;
            padding-top: 10px;
        }
        .nav-item {
            margin-bottom: 5px;
        }
    }

    /* --- HERO HEADER --- */
    .hero-catalog {
        text-align: center;
        padding-top: 150px;
        padding-bottom: 30px;
    }
    .hero-catalog h2 {
        font-family: 'Cinzel', serif;
        font-weight: 700;
        font-size: 2.2rem;
        letter-spacing: 3px;
        margin-bottom: 10px;
    }
    .hero-catalog p {
        font-family: 'Playfair Display', serif;
        font-style: italic;
        color: #777;
        font-size: 1.1rem;
    }

    /* --- TEMPLATE CARD EDITORIAL --- */
    .template-card {
        padding: 12px;
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        background-color: #FFFFFF; 
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .template-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(140, 106, 94, 0.12);
    }

    .card-img-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 14px;
    }

    .template-card img {
        height: 500px;
        object-fit: cover;
        width: 100%;
        transition: transform 0.6s ease;
    }

    .template-card:hover img {
        transform: scale(1.05);
    }

    @media (max-width: 576px) {
        .template-card img {
            height: auto;
            aspect-ratio: 3/4;
        }
    }

    .template-card .p-3 {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 20px 10px 10px 10px !important;
    }

    .template-title {
        font-family: 'Cinzel', serif;
        font-weight: 700;
        font-size: 16px;
        letter-spacing: 1px;
        margin-bottom: 15px;
        text-align: center;
    }

    .edition-label {
        font-family: 'Playfair Display', serif;
        font-style: italic;
        font-size: 0.85rem;
        color: var(--accent-gold);
        font-weight: 500;
        margin-bottom: 4px;
        text-align: center;
    }

    /* --- BUTTONS --- */
    .template-btns {
        margin-top: 8px;
        margin-bottom: 4px;
    }
    
    .template-btns .btn {
        padding: 11px 15px;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        border-radius: 8px;
        transition: all 0.3s ease;
        width: 100%;
    }

    .template-btns .btn-primary {
        background-color: transparent;
        color: var(--dark-text);
        border: 1px solid #DDD;
    }

    .template-btns .btn-primary:hover {
        background-color: var(--dark-text);
        color: #FFFFFF;
        border-color: var(--dark-text);
    }

    .template-btns .btn-secondary {
        background-color: var(--btn-premium);
        border: none;
        color: #FFFFFF;
    }

    .template-btns .btn-secondary:hover {
        background-color: #735449;
        box-shadow: 0 4px 12px rgba(140, 106, 94, 0.3);
    }

    /* --- FLOATING WHATSAPP --- */
    .whatsapp-float {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 30px;
        right: 30px;
        z-index: 100;
        background-color: #25d366 !important;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 20px rgba(37, 213, 102, 0.3);
        transition: all 0.3s ease;
    }

    .whatsapp-float:hover {
        transform: scale(1.1) rotate(8deg);
    }

    .whatsapp-float img {
        width: 30px;
        height: 30px;
    }
  </style>
</head>
<body>

    <!-- NAV BAR -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <!-- Brand name diperbarui menjadi Nanti Kita -->
            <a class="navbar-brand-text" href="index.php">Nanti Kita</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item top-item">
                        <a class="item active" aria-current="page" href="index.php">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="item" aria-current="page" href="#">Template</a>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        <a class="item-bi" href="https://www.instagram.com/nanti.kita/" target="_blank"><i class="bi bi-instagram"></i></a>
                        <a class="item-bi" href="https://wa.me/6289530633452" target="_blank"><i class="bi bi-whatsapp"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO HEADER -->
    <div class="hero-catalog">
        <h2>Daftar Template</h2>
        <p>Temukan desain undangan digital impian Anda bersama Nanti Kita</p>
    </div>

    <!-- KATALOG TEMPLATE -->
    <div class="container my-4">
        <div class="row g-4">

            <!-- TEMPLATE 1: CRIMSON & PINE -->
            <div class="col-6 col-md-4 col-lg-4">
                <div class="template-card">
                    <div class="card-img-wrapper">
                        <img src="temp/crimson/assets/img/cov-crimsonpine.png" alt="Crimson & Pine">
                    </div>
                    <div class="p-3">
                        <div class="template-title">Crimson & Pine</div>
                        <div>
                            <div class="template-btns">
                                <a href="temp/crimson/crimson-pine.php" class="btn btn-primary">Lihat Basic</a>
                            </div>
                            <div class="template-btns">
                                <a href="temp/crimson/crimson-pine.php?guest=11111111" class="btn btn-secondary">Lihat Premium</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TEMPLATE 2: AKSARA RASA (Special Edition) -->
            <div class="col-6 col-md-4 col-lg-4">
                <div class="template-card">
                    <div class="card-img-wrapper">
                        <img src="temp/aksara/assets/img/aksara.png" alt="Aksara Rasa">
                    </div>
                    <div class="p-3">
                        <div>
                            <div class="edition-label">Special Edition :</div>
                            <div class="template-title">Aksara Rasa</div>
                        </div>
                        <div>
                            <div class="template-btns">
                                <a href="temp/aksara/aksara-rasa.php" class="btn btn-primary">Lihat Basic</a>
                            </div>
                            <div class="template-btns">
                                <a href="temp/aksara/aksara-rasa.php?guest=11111111" class="btn btn-secondary">Lihat Premium</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TEMPLATE 3: MODERN CLEAN -->
            <div class="col-6 col-md-4 col-lg-4">
                <div class="template-card">
                    <div class="card-img-wrapper">
                        <img src="temp/modern/assets/img/cover-modern.jpg" alt="Modern Clean">
                    </div>
                    <div class="p-3">
                        <div class="template-title">Modern Clean</div>
                        <div>
                            <div class="template-btns">
                                <a href="temp/modern/modern-clean.php" class="btn btn-primary">Lihat Basic</a>
                            </div>
                            <div class="template-btns">
                                <a href="temp/modern/modern-clean.php?guest=11111111" class="btn btn-secondary">Lihat Premium</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- WHATSAPP FLOATING BUTTON -->
    <a href="https://wa.me/6289530633452" class="whatsapp-float" target="_blank" title="Hubungi Admin via WhatsApp">
        <img src="https://img.icons8.com/color/48/000000/whatsapp--v1.png" alt="WhatsApp" />
    </a>

</body>
</html>