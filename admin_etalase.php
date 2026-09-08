<?php

session_start();
include 'db/conn.php';
include 'db/log_tracker.php';

// Cek koneksi database
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk mengambil data dari tabel menu
$query = "SELECT * FROM menu ORDER BY id_menu ASC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error query: " . mysqli_error($conn));
}

// Cek session login
if (!isset($_SESSION['namauser'])) {
    header('Location: login');
    exit;
}
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
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
      rel="stylesheet"
    />
    <style>
            * {
            user-select: none;
        }
    </style>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- My Style -->
    <link rel="stylesheet" href="css/style1.css" />
    <style>
    /* Orderan */
          .container {
        width: 90%;
        max-width: 1200px;
        margin: 80px auto 20px;
        margin-top: 100px;
      }
    .orderan  {
      text-align: center;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .orderan .order-cards-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
    }

    .orderan .order-cards-container .order-card {
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 20px;
      width: 300px;
      text-align: center;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .orderan .order-cards-container .order-circle {
      background-color: #ff5722;
      color: white;
      font-size: 20px;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0 auto 10px;
    }

    .orderan .order-cards-container .order-details p {
      margin: 5px 0;
      font-size: 16px;
      text-align: left; /* Rata kiri */
      color: white;
    }

    .orderan .order-cards-container .btn-selesai {
      background-color: red;
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
      width: 100px;
      margin-top: 10px;
    }

    .orderan .order-cards-container .btn-selesai.selesai {
      background-color: green;
    }

    .btn-selesai {
    background-color: red;
    color: white;
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    display: block;
    margin: 20px auto;
    }

    .btn-selesai:hover {
        background-color: darkred;
    }

    /* Total Menu */
.total-menu {
  text-align: center;
  color: white;
}

.total-menu .menu-summary-container {
  display: flex;
  justify-content: center;
  gap: 20px;
  margin-top: 20px;
}

.total-menu .menu-summary-box {
  border: 1px solid white;
  border-radius: 8px;
  padding: 20px;
  width: 300px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  background-color: none;
}

.total-menu .menu-summary-box img {
  border-radius: 8px;
}

.total-menu .menu-summary-box p {
  color: white;
  font-size: 18px;
  margin-top: 10px;
}


table {
        width: 100%;
        border-collapse: collapse;
        background-color: #333;
        color: white;
      }
      table, th, td {
        border: 1px solid white;
      }
      th, td {
        padding: 5px;
        text-align: center;
      }
      th {
        background-color: #444;
      }



    /* Responsif untuk tablet */
    @media (max-width: 768px) {
    .orderan .order-cards-container .order-card {
        width: 45%;
      }

    .orderan .order-cards-container .order-details p {
        margin: 5px 0;
        font-size: 12px;
        text-align: left; /* Rata kiri */
      }

    .total-menu .menu-summary-container .menu-summary-container p {
        font-size: 10px;
        margin-top: 5px;
      }

    .total-menu .menu-summary-container .menu-summary-container p span {
        font-weight: bold;
        font-size: 2rem;
    }}

    /* Responsif untuk HP */
    @media (max-width: 480px) {
        .orderan .order-cards-container .order-card {
            width: 90%;
        }

        .orderan .order-cards-container .order-details p {
            margin: 5px 0;
            font-size: 8px;
            text-align: left; /* Rata kiri */
        }

        .total-menu .menu-summary-container .menu-summary-container p {
        font-size: 10px;
            margin-top: 5px;
        }

        .total-menu .menu-summary-container .menu-summary-container p span {
            font-weight: bold;
            font-size: 2rem;
        }
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

<div class="navbar-nav">
        <a href="/adminview.php">Pesanan</a>
    </div>

<form action="">
        <div class="navbar-extra">
          <!-- <div id="search-box" class="searchbox hidden">
            <input type="text" placeholder=" Search..." id="search-input" />
          </div> 
          <a href="#" id="search-icon"><i data-feather="search"></i></a>
          <a href="/shops" id="shopping-cart"><i data-feather="shopping-cart"></i></a> -->
          <a href="/home""
            ><i data-feather="home"></i
          ></a>
        <!--  <a href="#" id="menu"><i data-feather="menu"></i></a> -->
        </div>
      </form>
    </nav>
    <!-- Navbar End -->

    <!-- Menu Section Start -->

<div class="container">
      <p class="orderan">Etalase Menu</p>

      <table>
        <tr>
          <th>Id Menu</th>
          <th>Gambar Menu</th>
          <th>Nama Menu</th>
          <th>Harga</th>
          <th>Stock</th>
          <th>Action</th>
        </tr>
        
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
          <td><?= $row['id_menu']; ?></td>
          <td><img src="<?= $row['gambar_menu']; ?>" width="50" height="50"></td>
          <td><?= $row['menu']; ?></td>
          <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
          <td><?= $row['stock']; ?></td>
          <td>
            <a href="formubah.php?id=<?= $row['id_menu']; ?>" class="btn-selesai">Ubah</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </table>
    </div>


    <!-- Footer Start -->
    <footer>
      <div class="credit">
        <p>Created by <a href="">WNS Admin</a>. | &copy; 2025.</p>
      </div>
    </footer>
    <!-- Footer End -->

    <!-- Icons -->
<script>
      feather.replace();
    </script>
  </body>
</html>
