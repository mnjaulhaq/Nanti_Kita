<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nanti Kita - Premium Digital Invitation</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <style>
      @font-face {
        font-family: "Tan Nimbus";
        src: url("{{ asset('fonts/tan-nimbus.ttf') }}") format("truetype");
        font-weight: normal;
        font-style: normal;
      }

      html { scroll-behavior: smooth; }

      :root {
        --bg-color: #2f3e36;
        --light-text: #f7f7f7;
        --card-bg: #f7f7f7;
        --accent-gold: #e2c295;
        --btn-primary-border: #f7f7f7;
      }

      body {
        background-color: var(--bg-color);
        font-family: "Montserrat", sans-serif;
        color: var(--light-text);
      }

      .navbar {
        background-color: rgba(47, 62, 54, 0.96);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        padding: 10px 40px;
        border-bottom: 1px solid rgba(247, 247, 247, 0.08);
      }

      .container-navbar-custom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        max-width: 100%;
      }

      .nav-logo-img {
        height: 52px;
        width: auto;
        object-fit: contain;
      }

      .navbar-center-menu {
        display: flex;
        gap: 4px;
        align-items: center;
        background-color: rgba(247, 247, 247, 0.04);
        border: 1px solid rgba(247, 247, 247, 0.08);
        padding: 6px;
        border-radius: 30px;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
        position: relative;
      }

      .nav-bg-slider {
        position: absolute;
        height: calc(100% - 12px);
        background-color: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 20px;
        left: 6px;
        width: 0;
        transition: all 0.35s cubic-bezier(0.25, 1, 0.5, 1);
        z-index: 1;
      }

      .nav-bg-slider.no-animation { transition: none !important; }

      .center-menu-item {
        color: rgba(247, 247, 247, 0.65);
        font-size: 0.88rem;
        font-weight: 500;
        text-decoration: none;
        padding: 8px 18px;
        border-radius: 20px;
        transition: color 0.25s ease;
        position: relative;
        z-index: 2;
      }

      .center-menu-item:hover { color: #fff; }
      .center-menu-item.active {
        color: #ffffff !important;
        font-weight: 600;
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
      }

      .custom-hamburger-capsule {
        background-color: rgba(247, 247, 247, 0.06);
        border: 1px solid rgba(247, 247, 247, 0.15);
        padding: 6px 10px;
        border-radius: 30px;
        display: flex;
        align-items: center;
        cursor: pointer;
        transition: all 0.2s ease;
      }

      .custom-hamburger-capsule:hover { background-color: rgba(247, 247, 247, 0.12); }
      .custom-hamburger-capsule .menu-icon {
        color: rgba(247, 247, 247, 0.9);
        font-size: 1.2rem;
        display: block;
      }

      .nantikita-menu {
        display: block;
        position: absolute;
        top: 75px;
        right: 40px;
        background-color: rgba(47, 62, 54, 0.75) !important;
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(247, 247, 247, 0.12);
        padding: 16px;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        z-index: 1050;
        min-width: 190px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-15px) scale(0.95);
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
      }

      .nantikita-menu.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0) scale(1);
      }

      .dropdown-item-link {
        display: block;
        color: rgba(247, 247, 247, 0.7);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        padding: 10px 14px;
        text-align: right;
        border-radius: 10px;
        transition: all 0.2s ease;
        margin-bottom: 2px;
      }

      .dropdown-item-link:hover, .dropdown-item-link.active {
        color: #ffffff !important;
        background-color: rgba(255, 255, 255, 0.08);
        padding-right: 18px;
      }

      .dropdown-divider {
        height: 1px;
        background-color: rgba(247, 247, 247, 0.1);
        margin: 12px 0;
      }

      .dropdown-social-wrapper span {
        font-size: 0.75rem;
        color: rgba(247, 247, 247, 0.4);
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: block;
        text-align: right;
      }

      .social-icons-box {
        display: flex;
        flex-direction: column;
        gap: 12px;
        width: 100%;
      }

      .social-icons-box .item-bi {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
        color: rgba(247, 247, 247, 0.8);
        font-size: 0.9rem;
        text-decoration: none;
        transition: color 0.2s ease;
      }

      .social-icons-box .item-bi i { font-size: 1.1rem; }
      .social-icons-box .item-bi:hover, .social-icons-box .item-bi:hover i { color: #bfa37a; }

      .hero-catalog {
        text-align: center;
        padding-top: 140px;
        padding-bottom: 30px;
      }

      .hero-catalog h2 {
        font-family: "Tan Nimbus", serif !important;
        font-size: 2.6rem;
        margin-bottom: 12px;
      }

      .hero-catalog p {
        font-style: italic;
        color: rgba(247, 247, 247, 0.7);
      }

      .template-card {
        padding: 12px;
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.4s ease;
        background-color: var(--card-bg);
        height: 100%;
        display: flex;
        flex-direction: column;
      }

      .template-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
      }

      .card-img-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 14px;
        width: 100%;
        aspect-ratio: 3 / 3.8;
        max-height: 420px;
      }

      .card-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top center;
        transition: transform 0.6s ease;
      }

      .template-card:hover img { transform: scale(1.05); }

      .template-card .p-2-custom {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 20px 10px 10px 10px;
      }

      .template-title {
        font-family: "Cinzel", serif;
        font-weight: 700;
        font-size: 16px;
        letter-spacing: 1px;
        margin-bottom: 15px;
        text-align: center;
        color: #2f3e36;
      }

      .edition-label {
        font-family: "Playfair Display", serif;
        font-style: italic;
        font-size: 0.85rem;
        color: #a98467;
        margin-bottom: 4px;
        text-align: center;
      }

      .template-btns { margin-top: 8px; margin-bottom: 4px; }
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
        color: #2f3e36;
        border: 1px solid #ced4da;
      }

      .template-btns .btn-primary:hover {
        background-color: #2f3e36;
        color: #ffffff;
        border-color: #2f3e36;
      }

      .template-btns .btn-secondary {
        background-color: var(--bg-color);
        border: 1px solid var(--bg-color);
        color: var(--light-text);
      }

      .template-btns .btn-secondary:hover {
        background-color: #1e2924;
        border-color: #1e2924;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      }

      .price-card {
        background-color: var(--card-bg);
        border-radius: 24px;
        padding: 35px 28px;
        border: 1px solid rgba(47, 62, 54, 0.05);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        position: relative;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
      }

      .price-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.18);
        border-color: rgba(47, 62, 54, 0.15);
      }

      .price-card.popular {
        background-color: #24302a !important;
        border: 1px solid rgba(226, 194, 149, 0.3);
      }

      .price-card.popular:hover {
        border-color: var(--accent-gold);
        box-shadow: 0 20px 45px rgba(226, 194, 149, 0.15);
      }

      .popular-badge {
        position: absolute;
        top: -1px;
        left: 50%;
        transform: translateX(-50%);
        background-color: var(--accent-gold);
        color: #2f3e36;
        font-size: 9px;
        font-weight: 700;
        padding: 6px 18px;
        border-radius: 0 0 12px 12px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        box-shadow: 0 4px 12px rgba(226, 194, 149, 0.25);
      }

      .price-header {
        text-align: center;
        border-bottom: 1px solid rgba(47, 62, 54, 0.06);
        padding-bottom: 22px;
        margin-bottom: 22px;
      }

      .price-card.popular .price-header { border-bottom-color: rgba(247, 247, 247, 0.08); }
      .package-name {
        font-family: "Playfair Display", serif;
        font-weight: 700;
        font-size: 1.15rem;
        color: #2f3e36;
        margin-bottom: 12px;
      }

      .price-card:hover .package-name { color: #a98467; }
      .price-card.popular .package-name { color: var(--accent-gold); }
      .price-card.popular:hover .package-name { color: #ffffff; }

      .price-amount {
        font-weight: 800;
        font-size: 1.9rem;
        color: #2f3e36;
      }

      .price-card.popular .price-amount { color: #f7f7f7; }
      .price-sub { font-size: 0.8rem; color: #a98467; margin-top: 4px; }

      .price-features { list-style: none; padding: 0; margin: 0 0 30px 0; }
      .price-features li {
        font-size: 0.9rem;
        color: #4a5750;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: transform 0.2s ease;
      }

      .price-card:hover .price-features li { transform: translateX(2px); }
      .price-card.popular .price-features li { color: rgba(247, 247, 247, 0.85); }

      .price-features li i.bi-check-circle-fill { color: #2f3e36; transition: transform 0.3s ease; }
      .price-card:hover .price-features li i.bi-check-circle-fill { transform: scale(1.15); }
      .price-card.popular .price-features li i.bi-check-circle-fill { color: var(--accent-gold); }

      .btn-price-outline {
        display: block;
        width: 100%;
        padding: 13px;
        color: #2f3e36;
        border: 1px solid #2f3e36;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-align: center;
        text-decoration: none;
        transition: all 0.3s ease;
      }

      .btn-price-outline:hover {
        background-color: #2f3e36;
        color: #ffffff;
        transform: translateY(-2px);
      }

      .btn-price-solid {
        display: block;
        width: 100%;
        padding: 13px;
        background-color: var(--accent-gold);
        color: #2f3e36;
        border: 1px solid var(--accent-gold);
        border-radius: 12px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-align: center;
        text-decoration: none;
        transition: all 0.3s ease;
      }

      .btn-price-solid:hover {
        background-color: #ffffff;
        border-color: #ffffff;
        transform: translateY(-3px);
      }

      .step-card {
        background-color: var(--card-bg);
        border-radius: 22px;
        padding: 35px 26px;
        border: 1px solid rgba(47, 62, 54, 0.04);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: all 0.4s ease;
      }

      .step-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 35px rgba(0, 0, 0, 0.12);
        border-color: rgba(226, 194, 149, 0.3);
      }

      .step-card.highlight {
        border: 1px dashed var(--accent-gold);
        background-color: rgba(247, 247, 247, 0.97);
      }

      .step-number {
        font-family: "Playfair Display", serif;
        font-size: 2.8rem;
        font-weight: 900;
        font-style: italic;
        color: var(--accent-gold);
        line-height: 1;
        margin-bottom: 18px;
        transition: all 0.3s ease;
        display: inline-block;
      }

      .step-card:hover .step-number { transform: scale(1.1) rotate(-3deg); color: #2f3e36; }
      .step-title { font-weight: 700; font-size: 1.1rem; color: #2f3e36; margin-bottom: 12px; }
      .step-desc { font-size: 0.88rem; color: #5c6b62; line-height: 1.6; margin: 0; }

      @media (max-width: 767px) {
        .price-card { padding: 28px 20px; border-radius: 20px; }
        .price-amount { font-size: 1.7rem; }
        .step-card { padding: 24px 20px; flex-direction: row; gap: 18px; align-items: flex-start; }
        .step-number { font-size: 2.2rem; }
        .navbar { padding: 10px 20px; }
        .navbar-center-menu { display: none; }
        .nantikita-menu { right: 20px; top: 70px; width: 200px; }
        .hero-catalog { padding: 110px 30px 20px 30px !important; }
        .hero-catalog h2 { font-size: 1.6rem !important; line-height: 1.3; }
        .template-card .p-2-custom { padding: 12px 5px 5px 5px !important; }
        .template-title { font-size: 9.5px !important; margin-bottom: 10px; word-break: break-word; }
        .template-btns .btn { padding: 5px 2px !important; font-size: 8px !important; }
      }

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

      .whatsapp-float:hover { transform: scale(1.1) rotate(8deg); }
      .whatsapp-float img { width: 30px; height: 30px; }

      .price-card.auto-hover, .step-card.auto-hover {
        transform: translateY(-10px) !important;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.18) !important;
        border-color: rgba(47, 62, 54, 0.15) !important;
      }
    </style>
  </head>
  <body id="top">
    <nav class="navbar fixed-top">
      <div class="container-fluid container-navbar-custom">
        <a class="navbar-brand-logo" href="#">
          <img src="{{ asset('images/Logo NantiKita.png') }}" alt="Logo Nanti Kita" class="nav-logo-img" />
        </a>

        <div class="navbar-center-menu">
          <div class="nav-bg-slider"></div>
          <a class="center-menu-item" href="#">Katalog Template</a>
          <a class="center-menu-item" href="#harga">Harga & Paket</a>
          <a class="center-menu-item" href="#cara-order">Cara Order</a>
        </div>

        <button class="custom-hamburger-capsule" type="button" onclick="toggleMenu()">
          <i class="bi bi-list menu-icon"></i>
        </button>

        <div class="nantikita-menu" id="myDropdown">
          <div class="mobile-menu-links">
            <a class="dropdown-item-link" href="#katalog">Katalog Template</a>
            <a class="dropdown-item-link" href="#harga">Harga & Paket</a>
            <a class="dropdown-item-link" href="#cara-order">Cara Order</a>
            <div class="dropdown-divider"></div>
          </div>

          <div class="dropdown-social-wrapper">
            <span>Hubungi Kami:</span>
            <div class="social-icons-box">
              <a class="item-bi" href="https://www.instagram.com/nantikitadigitalwedding" target="_blank">
                <i class="bi bi-instagram"></i> Instagram
              </a>
              <a class="item-bi" href="https://wa.me/628976337088" target="_blank">
                <i class="bi bi-whatsapp"></i> WhatsApp
              </a>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <div class="hero-catalog">
      <h2>Katalog Template</h2>
      <p>Temukan desain undangan digital impian Anda bersama Nanti Kita</p>
    </div>

    <div id="katalog" class="container my-5">
      <div class="row g-3">
        
        <div class="col-6 col-md-4 col-lg-4">
          <div class="template-card">
            <div class="card-img-wrapper">
              <img src="{{ asset('themes/rustic/assets/img/rustic-thumbnail.jpeg') }}" alt="rustic" />
            </div>
            <div class="p-2-custom">
              <div class="template-title">RUSTIC</div>
              <div class="button-group-wrapper">
                <div class="template-btns">
                  <a href="{{ url('/wedding/budi-dan-riri?theme=rustic&paket=basic&from_katalog=true') }}" class="btn btn-primary" target="_blank">Lihat Basic</a>
                </div>
                <div class="template-btns">
                  <a href="{{ url('/wedding/budi-dan-riri?theme=rustic&paket=premium&from_katalog=true') }}" class="btn btn-secondary" target="_blank">Lihat Premium</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-4">
          <div class="template-card">
            <div class="card-img-wrapper">
              <img src="{{ asset('themes/modern/assets/img/cover-modern.jpg') }}" alt="Modern Minimalist" />
            </div>
            <div class="p-2-custom">
              <div>
                <div class="edition-label">Special Edition :</div>
                <div class="template-title">MODERN MINIMALIST</div>
              </div>
              <div class="button-group-wrapper">
                <div class="template-btns">
                  <a href="{{ url('/wedding/budi-dan-riri?theme=modern&paket=basic&from_katalog=true') }}" class="btn btn-primary" target="_blank">Lihat Basic</a>
                </div>
                <div class="template-btns">
                  <a href="{{ url('/wedding/budi-dan-riri?theme=modern&paket=premium&from_katalog=true') }}" class="btn btn-secondary" target="_blank">Lihat Premium</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-4">
          <div class="template-card">
            <div class="card-img-wrapper">
              <img src="{{ asset('themes/sage/assets/img/cover-sage-botanical.jpg') }}" alt="sage green & botanical" />
            </div>
            <div class="p-2-custom">
              <div class="template-title">SAGE GREEN & BOTANICAL</div>
              <div class="button-group-wrapper">
                <div class="template-btns">
                  <a href="{{ url('/wedding/budi-dan-riri?theme=sage&paket=basic&from_katalog=true') }}" class="btn btn-primary" target="_blank">Lihat Basic</a>
                </div>
                <div class="template-btns">
                  <a href="{{ url('/wedding/budi-dan-riri?theme=sage&paket=premium&from_katalog=true') }}" class="btn btn-secondary" target="_blank">Lihat Premium</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-4">
          <div class="template-card">
            <div class="card-img-wrapper">
              <img src="{{ asset('themes/japandi/assets/img/cover-japandi.jpg') }}" alt="japandi" />
            </div>
            <div class="p-2-custom">
              <div class="template-title">JAPANDI</div>
              <div class="button-group-wrapper">
                <div class="template-btns">
                  <a href="{{ url('/wedding/budi-dan-riri?theme=japandi&paket=basic&from_katalog=true') }}" class="btn btn-primary" target="_blank">Lihat Basic</a>
                </div>
                <div class="template-btns">
                  <a href="{{ url('/wedding/budi-dan-riri?theme=japandi&paket=premium&from_katalog=true') }}" class="btn btn-secondary" target="_blank">Lihat Premium</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-4">
          <div class="template-card">
            <div class="card-img-wrapper">
              <img src="{{ asset('themes/cinematic/assets/img/cover-cinematic.jpg') }}" alt="cinematic" />
            </div>
            <div class="p-2-custom">
              <div class="template-title">CINEMATIC</div>
              <div class="button-group-wrapper">
                <div class="template-btns">
                  <a href="{{ url('/wedding/budi-dan-riri?theme=cinematic&paket=basic&from_katalog=true') }}" class="btn btn-primary" target="_blank">Lihat Basic</a>
                </div>
                <div class="template-btns">
                  <a href="{{ url('/wedding/budi-dan-riri?theme=cinematic&paket=premium&from_katalog=true') }}" class="btn btn-secondary" target="_blank">Lihat Premium</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-4 col-lg-4">
          <div class="template-card">
            <div class="card-img-wrapper">
              <img src="{{ asset('themes/midnight/assets/img/cover-midnight.jpg') }}" alt="midnight" />
            </div>
            <div class="p-2-custom">
              <div class="template-title">MIDNIGHT & ROMANCE</div>
              <div class="button-group-wrapper">
                <div class="template-btns">
                  <a href="{{ url('/wedding/budi-dan-riri?theme=midnight&paket=basic&from_katalog=true') }}" class="btn btn-primary" target="_blank">Lihat Basic</a>
                </div>
                <div class="template-btns">
                  <a href="{{ url('/wedding/budi-dan-riri?theme=midnight&paket=premium&from_katalog=true') }}" class="btn btn-secondary" target="_blank">Lihat Premium</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>

    <div id="harga" class="container my-5">
      <div class="row g-4 justify-content-center align-items-stretch">
        <div class="col-12 col-md-5 col-lg-4 scroll-trigger">
          <div class="price-card">
            <div class="price-header">
              <div class="package-name">PAKET BASIC</div>
              <div class="price-amount">Rp 99.000</div>
              <div class="price-sub">Aktif 3 Bulan</div>
            </div>
            <div class="price-body">
              <ul class="price-features">
                <li><i class="bi bi-check-circle-fill"></i> Custom Nama Tamu</li>
                <li><i class="bi bi-check-circle-fill"></i> Teks & Protokol Kesehatan</li>
                <li><i class="bi bi-check-circle-fill"></i> Navigasi Peta Lokasi (Google Maps)</li>
                <li><i class="bi bi-check-circle-fill"></i> Galeri Foto (Maks 5 Foto)</li>
                <li><i class="bi bi-check-circle-fill"></i> Fitur Angpao Digital / Rekening</li>
                <li><i class="bi bi-x-circle-fill text-muted"></i> Tanpa Background Musik Custom</li>
                <li><i class="bi bi-x-circle-fill text-muted"></i> Tanpa Fitur RSVP & Ucapan</li>
              </ul>
            </div>
            <div class="price-footer">
              <a href="https://wa.me/628976337088?text=Halo%20Admin%20Nanti%20Kita,%20saya%20mau%20order%20Paket%20Basic" class="btn btn-price-outline" target="_blank">Pilih Paket</a>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-5 col-lg-4 scroll-trigger">
          <div class="price-card popular">
            <div class="popular-badge">PASTILAH PILIH INI</div>
            <div class="price-header">
              <div class="package-name">PAKET PREMIUM</div>
              <div class="price-amount">Rp 149.000</div>
              <div class="price-sub">Aktif Selamanya / 1 Tahun</div>
            </div>
            <div class="price-body">
              <ul class="price-features">
                <li><i class="bi bi-check-circle-fill"></i> Semua Fitur Paket Basic</li>
                <li><i class="bi bi-check-circle-fill"></i> Masa Aktif Lebih Lama</li>
                <li><i class="bi bi-check-circle-fill"></i> Galeri Foto & Video Tanpa Batas</li>
                <li><i class="bi bi-check-circle-fill"></i> Background Musik Bebas Request</li>
                <li><i class="bi bi-check-circle-fill"></i> Fitur RSVP & Konfirmasi Kehadiran</li>
                <li><i class="bi bi-check-circle-fill"></i> Kolom Ucapan & Doa Restu (Live)</li>
                <li><i class="bi bi-check-circle-fill"></i> Fitur Spesial Story/Kisah Cinta</li>
              </ul>
            </div>
            <div class="price-footer">
              <a href="https://wa.me/628976337088?text=Halo%20Admin%20Nanti%20Kita,%20saya%20mau%20order%20Paket%20Premium" class="btn btn-price-solid" target="_blank">Order Sekarang</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="cara-order" class="container my-5">
      <div class="row g-4 step-timeline-row">
        <div class="col-12 col-md-4 scroll-trigger">
          <div class="step-card">
            <div class="step-number">01</div>
            <div class="step-content">
              <div class="step-title">Pilih Desain</div>
              <p class="step-desc">Cari dan tentukan template undangan favorit Anda di katalog atas, lalu klik tombol paket yang diinginkan.</p>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-4 scroll-trigger">
          <div class="step-card highlight">
            <div class="step-number">02</div>
            <div class="step-content">
              <div class="step-title">Isi Data & Musik</div>
              <p class="step-desc">Konsultasikan via WhatsApp untuk pengisian data mempelai, galeri foto, lokasi acara, hingga request musik latar.</p>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-4 scroll-trigger">
          <div class="step-card">
            <div class="step-number">03</div>
            <div class="step-content">
              <div class="step-title">Undangan Siap Kirim</div>
              <p class="step-desc">Proses pengerjaan cepat. Undangan digital premium Anda siap disebarkan ke seluruh daftar tamu spesial.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <a href="https://wa.me/628976337088" class="whatsapp-float" target="_blank" title="Hubungi Admin via WhatsApp">
      <img src="https://img.icons8.com/color/48/000000/whatsapp--v1.png" alt="WhatsApp" />
    </a>

    <script>
      function toggleMenu() {
        var dropdown = document.getElementById("myDropdown");
        dropdown.classList.toggle("show");
      }

      window.onclick = function (e) {
        var dropdown = document.getElementById("myDropdown");
        if (dropdown && dropdown.classList.contains("show")) {
          var klikDiTombol = e.target.matches(".custom-hamburger-capsule") || e.target.matches(".menu-icon");
          if (!klikDiTombol && !dropdown.contains(e.target)) {
            dropdown.classList.remove("show");
          }
        }
      };

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
          slider.classList.add("no-animation");
          menuItems[0].classList.add("active");
          moveSlider(menuItems[0]);

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

      const scrollTriggers = document.querySelectorAll(".scroll-trigger");
      const hoverObserverOptions = {
        root: null,
        threshold: 0.5,
        rootMargin: "-10% 0px -10% 0px",
      };

      const hoverObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          const card = entry.target.querySelector(".price-card, .step-card");
          if (card) {
            if (entry.isIntersecting) {
              card.classList.add("auto-hover");
            } else {
              card.classList.remove("auto-hover");
            }
          }
        });
      }, hoverObserverOptions);

      scrollTriggers.forEach((el) => hoverObserver.observe(el));
    </script>
  </body>
</html>