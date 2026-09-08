<?php
// Fungsi untuk menghasilkan versi cache berdasarkan timestamp (waktu terakhir file diubah)
function autoVersion($file) {
    $filePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $file;
    
    // Mengecek apakah file ada
    if (file_exists($filePath)) {
        // Mengembalikan URL file dengan menambahkan query string berupa timestamp
        return $file . '?v=' . filemtime($filePath);
    } else {
        // Jika file tidak ditemukan, kembalikan URL tanpa modifikasi
        return $file;
    }
}
include 'db/log_tracker.php';
log_activity("Membuka halaman Utama");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Auto clear cache untuk CSS -->
    <link rel="stylesheet" href="<?php echo autoVersion('css/style1.css'); ?>">
    
    <!-- Auto clear cache untuk JavaScript -->
    <script src="<?php echo autoVersion('js/script.js'); ?>" defer></script>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- My Style -->
    <link rel="stylesheet" href="css/style1.css?v=1.1.20" />
    
    <title>WNS</title>
  </head>

  <body>

  
    <!-- Navbar Start -->
    <nav class="navbar">
        <!-- <a href="/home" class="navbar-logo">WN<span>S.</span></a>  -->
        <a href="/home">
            <img src="img/logo.png" style="width: 100px; height: auto;" alt="" />
        </a>

      <div class="navbar-nav">
        <a href="#home">Home</a>
        <a href="#about">Tentang Kami</a>
        <a href="#menus">Menu</a>
        <a href="#contact">Kontak</a>
      </div>

      <form action="">
        <div class="navbar-extra">
          <div id="search-box" class="searchbox hidden">
            <input type="text" placeholder=" Search..." id="search-input" />
          </div>
          <!-- <a href="#" id="search-icon"><i data-feather="search"></i></a> -->
          <a href="/shops" id="shopping-cart"
            ><i data-feather="shopping-cart"></i
          ></a>
          <a href="#" id="menu"><i data-feather="menu"></i></a>
        </div>
      </form>
    </nav>
    <!-- Navbar End -->

    <!-- Hero Section Start -->
    <section class="hero" id="home">
      <main class="content">
        <h1>Mari Nikmati</h1>
        <div class="wns">
          <h1>WN<span>S.</span></h1>
        </div>
        <p>
          WNS singkatan dari Watermelon Noodle & Smoothie, adalah produk unik
          yang menggabungkan mie dan smoothie berbahan dasar 100% semangka.
          Rasanya manis dan segar secara alami, tanpa bahan tambahan buatan,
          menjadikannya pilihan sehat dan lezat untuk dinikmati.
        </p>
        <a href="/shops" class="cta">Beli Sekarang</a>
      </main>
    </section>
    <!-- Hero Section End -->

    <!-- About Section Start -->
    <section id="about" class="about">
      <h2><span>Tentang</span> Kami</h2>
      <div class="row">
        <div class="about-img">
          <img src="img/menu.jpg" alt="Tentang Kami" />
        </div>
        <div class="content">
          <h3>Kenapa harus membeli produk kami?</h3>
          <p>
            Anda harus membeli Watermelon Noodle & Smoothie (WNS) karena produk
            kami 100% alami, terbuat sepenuhnya dari semangka tanpa bahan
            pengawet atau pemanis buatan. WNS menawarkan pengalaman segar dan
            sehat, kaya akan nutrisi seperti vitamin C dan antioksidan, serta
            memberikan rasa manis alami yang lezat. Nikmati cara baru
            mengonsumsi semangka dengan lebih menyenangkan dan menyehatkan!
          </p>
        </div>
      </div>
    </section>
    <!-- About Section End -->

    <!-- Menu Section Start -->
    <section id="menus" class="menus">
      <h2><span>Menu</span> Kami</h2>
      <p>Silahkan Memilih Menu Yang Kami Sediakan Dibawah ini!!!</p>

      <div class="row-card">
        <div class="menu-card" href="/shops">
          <img src="img/mie.jpg" alt="1" class="menu-card-img" />
          <h3 class="menu-card-title">
            Watermelon <br />
            Noodle
          </h3>
          <p class="menu-card-price">IDR 20K</p>
        </div>
        <div class="menu-card" href="/shops">
          <img src="img/jus.jpg" alt="2" class="menu-card-img" />
          <h3 class="menu-card-title">Smoothie Watermelon</h3>
          <p class="menu-card-price">IDR 15K</p>
        </div>
        <!-- <div class="menu-card">
          <img src="img/logo.jpeg" alt="3" class="menu-card-img" />
          <h3 class="menu-card-title">- Watermelon Noodle -</h3>
          <p class="menu-card-price">IDR 15K</p>
        </div>
        <div class="menu-card">
          <img src="img/logo.jpeg" alt="4" class="menu-card-img" />
          <h3 class="menu-card-title">- Watermelon Noodle -</h3>
          <p class="menu-card-price">IDR 15K</p>
        </div> -->
      </div>
    </section>
    <!-- Menu Section End -->

    <!-- Contact Section Start -->
    <section id="contact" class="contact">
      <h2><span>Lokasi</span> Bazar</h2>
      <p></p>

      <div class="row">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6674539908076!2d101.40599861741066!3d0.49826299442658306!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5a978b803fe87%3A0xe1ecff7409d983c7!2sInstitut%20Bisnis%20dan%20Teknologi%20Pelita%20Indonesia!5e0!3m2!1sid!2sid!4v1741176925548!5m2!1sid!2sid"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          class="map"
        ></iframe>
<!--
        <form action="">
          <div class="input-group">
            <i data-feather="user"></i>
            <input type="text" placeholder="Nama Pengguna" />
          </div>
          <div class="input-group">
            <i data-feather="mail"></i>
            <input type="text" placeholder="E-Mail" />
          </div>
          <div class="input-group">
            <i data-feather="phone"></i>
            <input type="text" placeholder="No Handphone" />
          </div>
          <button type="submit" class="btn">Kirim Pesan</button>
        </form> -->
      </div>
    </section>
    <!-- Contact Section End -->

    <!-- Footer Start -->
    <footer>
      <!-- <div class="social">
        <a href="#"><i data-feather="instagram"></i></a>
      </div> -->
      <div class="links">
        <a href="#home">Home</a> | <a href="#about">Tentang Kami</a> |
        <a href="#menus">Menu</a> |
        <a href="#kontak">Kontak</a>
      </div>
      <div class="credit">
        <p>Created by <a href="">WNS Admin</a>. | &copy; 2025.</p>
      </div>
    </footer>
    <!-- Footer End -->

    <!-- Icons -->
    <script>
      feather.replace();
    </script>
    <!-- Icons End -->

    <!-- Javascript -->
    <script src="js/script.js?v=1.1.0"></script>
    <!-- Javascript End -->
  </body>
</html>
