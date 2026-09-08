<?php
include 'db/conn.php';
include 'db/log_tracker.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WNS</title>

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
    <link rel="stylesheet" href="css/style1.css" />
    <style>
            * {
            user-select: none;
        }
    </style>
  </head>

  <body>
    <!-- Navbar Start -->
    <nav class="navbar">
        <!-- <a href="/home" class="navbar-logo">WN<span>S.</span></a>  -->
        <a href="/home">
            <img src="img/logo.png" style="width: 100px; height: auto;" alt="" />
        </a>
        
      <!-- <div class="navbar-nav">
        <a href="#home">Home</a>
        <a href="#about">Tentang Kami</a>
        <a href="#menus">Menu</a>
        <a href="#contact">Kontak</a>
      </div> -->

      <form action="">
        <div class="navbar-extra">
          <!-- <div id="search-box" class="searchbox hidden">
            <input type="text" placeholder="Search..." id="search-input" />
          </div>
          <a href="#" id="search-icon"><i data-feather="search"></i></a> 
          <a href="/shops" id="shopping-cart"
            ><i data-feather="shopping-cart"></i
          ></a> -->
          <a href="/home""
            ><i data-feather="home"></i
          ></a>
          <!-- <a href="#" id="menu"><i data-feather="menu"></i></a> -->
        </div>
      </form>
    </nav>
    <!-- Navbar End -->

    <!-- Login Start -->
    <section class="main-content">
      <div class="login-box">
        <a href="/home" class="navbar-logo">WN<span>S.</span></a>
        <form method="POST" action="db/logintime">
          <input type="text" id="user1" name="user1" placeholder="Username" required />
          <input type="password" id="pass2" name="pass2" placeholder="Password" required />
          <button type="submit" class="login-button">LOG IN</button>
          <?php if (!empty($error)) { echo '<p class="error-msg">' . $error . '</p>'; } ?>
        </form>
      </div>
    </section>
    <!-- Login End -->

    <!-- Footer Start -->
    <footer>
      <!-- <div class="social">
        <a href="#"><i data-feather="instagram"></i></a>
      </div> -->
      <!-- <div class="links">
        <a href="#home">Home</a> | <a href="#about">Tentang Kami</a> |
        <a href="#menus">Menu</a> |
        <a href="#kontak">Kontak</a>
      </div> -->
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
    <script src="js/script.js"></script>

    <script>
// Fungsi untuk menyaring karakter berbahaya dari input
function sanitizeInput(input) {
    return input.replace(/<.*?>/g, '');  // Menghapus tag HTML
}

// Menambahkan event listener untuk masing-masing elemen
document.getElementById('user1').addEventListener('input', function() {
    let sanitizedValue = sanitizeInput(this.value);
    this.value = sanitizedValue;  // Memperbarui nilai input dengan nilai yang sudah disaring
});

document.getElementById('pass2').addEventListener('input', function() {
    let sanitizedValue = sanitizeInput(this.value);
    this.value = sanitizedValue;  // Memperbarui nilai input dengan nilai yang sudah disaring
});

</script>
    <!-- Javascript End -->
  </body>
</html>
