<?php
session_start();
include 'db/conn.php';

// Generate current date and random order ID
$current_date_time = date('Y-m-d H:i:s');
$order_id = 'A' . sprintf('%03d', rand(1, 999)); // ID pesanan acak dengan format 3 digit

// Jika menerima POST request (saat order dikonfirmasi)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $namaplg = $_POST['namaplg'] ?? '';
    $notelpplg = $_POST['notelpplg'] ?? '';
    $email = $_POST['email'] ?? '';
    $quantity_1 = $_POST['quantity_1'] ?? 0;
    $quantity_2 = $_POST['quantity_2'] ?? 0;
    $total_price = $_POST['total_price'] ?? 0;
    $order_date = $current_date_time;
    $status = "Pending";

    // Cek apakah quantity_1 atau quantity_2 bernilai 0
    if ($namaplg == '' && notelpplg == '' && $quantity_1 == 0 && $quantity_2 == 0) {
        // Tampilkan pesan error jika salah satu kuantitas 0
        echo "<script>alert('Jangan Kosong Dong!!!'); window.location.href='shops';</script>";
        exit(); // Hentikan proses
    }

    // Simpan data ke database jika kuantitas valid
    $query = "INSERT INTO orders (order_id, namaplg, notelpplg, quantity_1, quantity_2, total_price, order_date, email, Status) 
              VALUES ('$order_id', '$namaplg', '$notelpplg', '$quantity_1', '$quantity_2', '$total_price', '$order_date', '$email', '$status')";

    if (mysqli_query($conn, $query)) {
        // Redirect ke halaman struk atau halaman sukses
        header("Location: struk?order_id=" . urlencode($order_id) . "&namaplg=" . urlencode($namaplg) . "&quantity_1=" . urlencode($quantity_1) . "&quantity_2=" . urlencode($quantity_2) . "&total_price=" . urlencode($total_price) . "&order_date=" . urlencode($order_date) . "&email=" . urlencode($email));
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WNS</title>

    <!-- My Style -->
    <style>
        * {
            user-select: none;
        }

        .menus h2 {
            font-size: 2.6rem;
            font-weight: 50000;
            font-style: bold;
        }

        .informations {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .informations input[type="text"],.informations input[type="number"] {
            width: 250px;
            padding: 10px;
            margin: 10px 0;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .informations input[type="text"]:focus ,.informations input[type="number"]:focus {
            border-color: #ff5722;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            outline: none;
        }

:root {
  --primary: green;
  --bg: black;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  outline: none;
  border: none;
  text-decoration: none;
  user-select: none;
}

html {
  scroll-behavior: smooth;
}

body {
  font-family: "Poppins", sans-serif;
  background-color: var(--bg);
  color: white;
  /* min-height: 3000px; */
}

/* Navbar */

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1.4rem 7%;
  background-color: rgba(1, 1, 1, 0.8);
  border-bottom: 1px solid var(--primary);
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 9999;
}

.navbar .navbar-logo {
  font-size: 3rem;
  font-weight: 700;
  color: rgb(255, 0, 0);
  font-style: italic;
}

.navbar .navbar-logo span {
  color: var(--primary);
}

.navbar .navbar-nav a {
  color: white;
  display: inline-block;
  font-size: 1rem;
  margin: 0 1rem;
}

.navbar .navbar-nav a:hover {
  color: rgb(115, 115, 115);
}

.navbar .navbar-nav a::after {
  content: "";
  display: block;
  padding-bottom: 0.5rem;
  border-bottom: 0.1rem solid rgb(115, 115, 115);
  transform: scaleX(0);
  transition: 0.2s linear;
}

.navbar .navbar-nav a:hover::after {
  transform: scaleX(0.5);
}

.navbar .navbar-extra a {
  color: white;
  margin: 0 0.5rem;
}

.navbar .navbar-extra a:hover {
  color: rgb(115, 115, 115);
}
.navbar form .navbar-extra {
  display: flex;
  align-items: center;
}

.navbar form .navbar-extra .searchbox {
  display: flex;
  align-items: center; /* Ini membuat input sejajar dengan icon secara vertikal */
  /* background-color: var(--primary); */
  color: white;
  border-radius: 100px;
  box-shadow: 1px 1px 3px rgba(1, 1, 3, 0.5);
  cursor: pointer;
  padding: 0.5rem;
  transition: width 0.5s ease, transform 0.5s ease;
}

.navbar form .navbar-extra .searchbox input {
  border: none;
  padding: 0.2rem;
  border-radius: 50px;
  width: 200px;
  height: 25px;
  font-size: 0.8rem;
  margin-left: 0.5rem; /* Berikan sedikit jarak antara input dan icon */
  transition: opacity 0.3s ease;
}

.navbar form .navbar-extra .hidden {
  display: none; /* Untuk menyembunyikan box pencarian */
}

#menu {
  display: none;
}

/* Hero Section */
.hero {
  min-height: 100vh;
  display: flex;
  align-items: center;
  background-image: url(../img/backgrounds.jpg);
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  position: relative;
}

.hero::after {
  content: "";
  display: block;
  position: absolute;
  width: 100%;
  height: 30%;
  bottom: 0;
  background: linear-gradient(
    0deg,
    rgba(1, 1, 3, 1) 8%,
    rgba(255, 255, 255, 0) 55%
  );
}

.hero .content {
  padding: 1.4rem 7%;
  max-width: 60rem;
}

.hero .content h1 {
  font-size: 4em;
  color: white;
  text-shadow: 1px 1px 3px rgba(1, 1, 3, 0.5);
  line-height: 1.2;
  max-width: 40rem;
}

.hero .content .wns h1 {
  color: red;
  font-style: italic;
}

.hero .content h1 span {
  color: var(--primary);
}

.hero .content p {
  font-size: 1.1rem;
  margin-top: 0.5rem;
  line-height: 2;
  font-weight: 700;
  font-style: bold;
  color: white;
  text-shadow: 1px 3px 5px rgb(16, 0, 0);
  /* mix-blend-mode: difference; */
}

.hero .content .cta {
  margin-top: 1rem;
  display: inline-block;
  padding: 1rem 3rem;
  font-size: 1.4rem;
  color: white;
  background-color: var(--primary);
  border-radius: 10px;
  box-shadow: 1px 1px 3px rgba(1, 1, 3, 0.5);
}

/* About Section */
.about,
.menus,
.contact {
  padding: 8rem 7% 1.4rem;
}

.about h2,
.menus h2,
.contact h2 {
  text-align: center;
  font-size: 2.6rem;
  margin-bottom: 3rem;
}

.menus h3 {
  font-size: 2rem;
  color: var(--bg);
}

.about h2 span,
.menus h2 span,
.contact h2 span {
  color: var(--primary);
}


.about .row {
  display: flex;
  color: var(--bg);
}

.about .row .about-img {
  flex: 1 1 45rem;
}

.about .row .about-img img {
  width: 100%;
  border-radius: 40px;
  box-shadow: 1px 1px 3px rgba(1, 1, 3, 0.5);
}

.about .row .content {
  flex: 1 1 35rem;
  padding: 0 1rem;
}

.about .row .content h3 {
  /* margin-top: 5.5rem; */
  font-size: 2.5rem;
  margin-bottom: 1rem;
}

.about .row .content p {
  margin-bottom: 0.8rem;
  font-size: 1.2rem;
  font-weight: 350;
  line-height: 2;
}

.about p {
  font-size: 1.2rem;
  font-weight: 350;
  line-height: 1.2;
  font-weight: bold;
}

/* Menu Section */

#menus {
  padding-top: 150px; /* Adjust the value as needed */
}

.menus {
  text-align: center;
  padding: 3rem 1rem;
}

.menus h2 {
  font-size: 2.5rem;
  margin-bottom: 1rem;
}

.menus p {
  font-size: 1.2rem;
  font-weight: 400;
  line-height: 1.4;
  font-weight: bold;
  margin-bottom: 2rem;
}

.menus .row {
  display: flex;
  flex-wrap: wrap; /* Membuat elemen menjadi fleksibel dan dapat menyesuaikan ukuran layar */
  justify-content: center; /* Menyusun item secara horizontal di tengah */
}

.menus .menu-card {
  background: #e9e9e9;
  border-radius: 10px;
  border-width: 2px;
  border-color: #cf3d3d;
  padding: 1.5rem;
  margin: 0.5rem;
  width: 300px; /* Lebar tetap untuk tiap menu */
  box-shadow: 0px 2px 10px rgb(255, 255, 255);
  transition: transform 0.3s ease;
}

.menus .menu-card:hover {
  transform: scale(1.05); /* Animasi saat hover */
}

.menus .menu-card-img {
  width: 100%;
  border-radius: 10px;
  margin-bottom: 1rem;
}

.menus .menu-card-title {
  font-size: 1.5rem;
  margin-top: 20px; /* Menambahkan jarak dari elemen atas */
  margin-bottom: 0.5rem;
}

.menus .menu-card-price {
  font-size: 1.2rem;
  font-weight: bold;
  color: black;
}

.menus h2,
.contact h2 {
  margin-bottom: 1rem;
}

.menus p,
.contact p {
  text-align: center;
  max-width: 30rem;
  margin: auto;
  color: black;
  font-weight: 300;
  line-height: 1.6;
}

.menus .row-card {
  display: flex;
  flex-wrap: wrap;
  margin-top: 5rem;
  justify-content: center;
  /* gap: 0; */
}

.menus .row-card .menu-card {
  text-align: center;
  padding-bottom: 4rem;
}

.menus .row-card .menu-card img {
  border-radius: 50%;
  width: 80%;
}

.menus .row-card .menu-card .menu-card-title {
  margin: 1.5rem auto 0.5rem;
}

/* Contact Section */
.contact .row {
  display: flex;
  margin-top: 2rem;
  background-color: #222;
  /* flex-wrap: wrap; */
}

.contact .row .map {
  flex: 1 1 45rem;
  width: 100%;
  object-fit: cover;
}

.contact .row form {
  flex: 1 1 45rem;
  padding: 5rem 2rem;
  text-align: center;
}

.contact .row form .input-group {
  display: flex;
  align-items: center;
  margin-top: 2rem;
  background-color: var(--bg);
  border: 1px solid #eee;
  padding-left: 2rem;
}

.contact .row form .input-group input {
  width: 100%;
  padding: 2rem;
  font-size: 1.7rem;
  background: none;
  color: white;
}

.contact .row form .btn {
  margin-top: 3rem;
  display: inline-block;
  padding: 1rem 3rem;
  font-size: 1.7rem;
  color: white;
  background-color: var(--primary);
  cursor: pointer;
  border-radius: 40px;
  box-shadow: 1px 1px 3px rgba(1, 1, 3, 0.5);
}


/* Footer */
footer {
  background-color: var(--primary);
  text-align: center;
  padding: 1rem 0 1rem;
  margin-top: 3rem;
}

footer .socials {
  padding: 1rem 0;
}

footer .socials a {
  color: white;
  margin: 1rem;
}

footer .socials a:hover,
footer .links a:hover {
  color: var(--bg);
}

footer .links {
  margin-bottom: 1.4rem;
  font-size: 1.5rem;
}

footer .links a {
  color: white;
  padding: 0.7rem 1rem;
}

footer .credit {
  font-size: 1.3rem;
}

footer .credit a {
  color: var(--bg);
  font-weight: 700;
}

/* Shops.html */

.player-id-container {
  background-color: #fff; /* Putih */
  border-radius: 12px; /* Sudut bulat */
  padding: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Shadow untuk efek 3D */
  margin-bottom: 20px; /* Ruang di bawah */
  border: 2px solid #fff; /* Border putih */
}

.step-number {
  background-color: #6431c3; /* Warna lingkaran */
  color: #fff;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  display: inline-flex;
  justify-content: center;
  align-items: center;
  font-size: 1rem;
  font-weight: bold;
}

h2 {
  display: inline-block;
  font-size: 18px;
  color: #333;
  margin: 0;
}

.input-wrapper {
  position: relative;
  margin-top: 15px;
}

input[type="text"] ,input[type="number"] {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 2px solid #e0e0e0;
  border-radius: 8px;
  outline: none;
}

input[type="text"]:focus,input[type="number"]:focus {
  border-color: #6431c3; /* Fokus warna ungu */
}

.help-icon {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  background-color: #6431c3;
  color: #fff;
  border-radius: 50%;
  width: 20px;
  height: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 14px;
  cursor: pointer;
}

.description {
  margin-top: 10px;
  font-size: 12px;
  color: transparent;
}


.order-box input[type="number"] {
  width: 50px;
  text-align: center;
  font-size: 18px;
  padding: 5px;
  border-radius: 8px;
  border: 1px solid #ddd;
  outline: none;
}

input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

input[type="number"] {
  -moz-appearance: textfield; /* Firefox */
}

.order-box button {
  background-color: #ff4500;
  border: none;
  padding: 5px 10px;
  font-size: 18px;
  color: white;
  border-radius: 8px; /* Rounded corners */
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.order-box button:hover {
  background-color: #ff7043; /* Lighter shade on hover */
}

#pay-btn {
  margin-top: 20px;
  padding: 10px 20px;
  background-color: #ff4500;
  color: white;
  border: none;
  border-radius: 12px; /* Rounded corners */
  cursor: pointer;
  font-size: 18px;
  transition: background-color 0.3s ease;
}

.bayar {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: 10px;
}

#pay-btn:hover {
  background-color: #ff7043; /* Lighter shade on hover */
}

/* Login Box*/

.main-content {
  flex: 1;
  margin-top: 100px;
  margin-bottom: 147px;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2rem;
}

.main-content .login-box {
  width: 350px;
  padding: 50px;
  background: white;
  box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
  border-radius: 10px;
  text-align: center;
  margin: 20px;
}

.main-content .login-box input[type="text"],
.main-content .login-box input[type="password"] {
  width: 100%;
  padding: 12px 20px;
  margin: 10px 0;
  background: whitefff;
  border: 1px solid #ddd;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  font-size: 16px;
  border-radius: 5px;
  transition: all 0.3s ease;
}

.main-content .login-box input[type="text"]:focus,
.main-content .login-box input[type="password"]:focus {
  border-color: var(--primary);
  box-shadow: 0 2px 8px rgba(0, 128, 0, 0.2);
}

.main-content .login-box .login-button {
  background-color: #00cc44;
  border: none;
  padding: 10px 20px;
  font-size: 16px;
  font-weight: bold;
  color: white;
  border-radius: 5px;
  cursor: pointer;
}

.main-content .login-box .login-button:hover {
  background-color: #009933;
}

.main-content .login-box .navbar-logo {
  font-size: 2rem;
  font-weight: 700;
  color: rgb(255, 0, 0);
  font-style: italic;
}

.main-content .login-box .navbar-logo span {
  color: var(--primary);
}

.main-content .login-box .navbar-nav a {
  color: white;
  display: inline-block;
  font-size: 1rem;
  margin: 0 1rem;
}

.main-content .login-box .navbar-nav a:hover {
  color: rgb(115, 115, 115);
}

.main-content .login-box .navbar-nav a::after {
  content: "";
  display: block;
  padding-bottom: 0.5rem;
  border-bottom: 0.1rem solid rgb(115, 115, 115);
  transform: scaleX(0);
  transition: 0.2s linear;
}

.main-content .login-box .navbar-nav a:hover::after {
  transform: scaleX(0.5);
}

#loading-screen {
            position: fixed;
            width: 100%;
            height: 100%;
            background: #0a070e;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease-out, visibility 0.5s;
        }

        /* Sembunyikan loading screen setelah halaman selesai dimuat */
        .loaded #loading-screen {
            opacity: 0;
            visibility: hidden;
        }

        /* Gaya logo */
        .logo {
            width: 100px; /* Sesuaikan ukuran logo */
            margin-bottom: 20px;
        }

        /* Progress Bar */
        .progress-bar {
            width: 200px;
            height: 10px;
            background: #555;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .progress {
            height: 100%;
            width: 0%;
            background: #4b57ff;
            transition: width 1s ease-in-out;
        }

        /* Teks "Memuat..." */
        .loading-text {
            color: white;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }


/* Media Queries */

/* Laptop */
@media (max-width: 1366px) {
  html {
    font-size: 100%;
  }
}

/* Tablet */
@media (max-width: 768px) {
  html {
    font-size: 62.5%;
  }

  #menu {
    display: inline-block;
  }

  .hero {
    background-position-x: -300px;
    background-position-y: 20px;
  }

  .navbar .navbar-nav {
    position: absolute;
    top: 100%;
    right: -100%;
    background-color: #212121;
    width: 25rem;
    height: 100vh;
    transition: 0.4s;
  }

  .navbar .navbar-nav.active {
    right: 0;
  }

  .navbar .navbar-nav a {
    color: white;
    display: block;
    margin: 1.5rem;
    padding: 0.5rem;
    font-size: 1.5rem;
  }

  .navbar .navbar-nav a::after {
    transform-origin: 0 0;
  }

  .navbar .navbar-nav a:hover::after {
    transform: scaleX(0.2);
  }

  .about .row {
    flex-wrap: wrap;
  }

  .about .row .about-img img {
    height: 24rem;
    object-fit: cover;
    object-position: center;
  }

  .about .row .content {
    padding: 0;
  }

  .about .row .content h3 {
    margin-top: 1rem;
    font-size: 2rem;
  }
  .about .row .content p {
    font-size: 1.6rem;
  }

  .contact .row {
    flex-wrap: wrap;
  }

  .contact .row .map {
    height: 30rem;
  }

  .contact .row form {
    padding-top: 0;
  }

  .navbar form .navbar-extra .searchbox input {
    width: 150px;
    height: 25px;
    font-size: 1rem;
  }

  .menus .row-card {
    margin-top: 2rem;
    justify-content: center;
    /* gap: 0; */
  }

  .menus .row-card .menu-card {
    padding-bottom: 1rem;
  }

  .menus .row-card .menu-card img {
    border-radius: 50%;
    width: 40%;
  }

  .menus .row-card .menu-card .menu-card-title {
    margin: 1rem auto 0.5rem;
  }
}

/* Mobile */
@media (max-width: 450px) {
  html {
    font-size: 55%;
  }
  .hero {
    background-position-x: -800px;
    background-position-y: 0px;
  }
}

    </style>

    <!-- Font & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>

<!-- Loading Screen -->
    <div id="loading-screen">
        <img src="img/logo.png" class="logo" alt="Loading...">
        <div class="progress-bar">
            <div class="progress" id="progress"></div>
        </div>
        <p class="loading-text">Memuat...</p>
    </div>

    <!-- Navbar Start -->
    <nav class="navbar">
        <!-- <a href="/home" class="navbar-logo">WN<span>S.</span></a>  -->
        <a href="/home">
            <img src="img/logo.png" style="width: 100px; height: auto;" alt="" />
        </a>
        
        <div class="navbar-extra">
            <!-- <a href="#" id="search-icon"><i data-feather="search"></i></a> 
            <a href="/shops" id="shopping-cart"><i data-feather="shopping-cart"></i></a> -->
          <a href="/home""
            ><i data-feather="home"></i
          ></a>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Menu Section Start -->
    <section id="menus" class="menus">

<div class="informationss">
    <div class="player-id-container">
        <div class="step-number">1</div>
        <h3>Identitas Diri</h2>
        <form action="" method="POST">
            <div class="input-wrapper">
                <input type="text" id="namaplg" name="namaplg" placeholder="Nama Pelanggan" required />
            </div>
            <div class="description">
                |
            </div>

            <!-- Nama dan Nomor Telepon -->
            <input type="number" id="notelpplg" name="notelpplg" placeholder="Nomor Telepon" required />

            <!-- Hidden inputs for quantities -->
            <input type="hidden" id="hidden_quantity1" name="quantity_1" value="0" />
            <input type="hidden" id="hidden_quantity2" name="quantity_2" value="0" />

            <!-- Total Price -->
            <input type="hidden" id="total_price" name="total_price" value="0" />
    </div>


        <div class="player-id-container">
        <div class="step-number">2</div>
        <h3>Pilih Menu Kami</h2>
        <p>Silahkan Memilih Menu Yang Kami Sediakan Dibawah ini!!!</p>
        <div class="row-card">
            <div class="menu-card" id="item1">
            <img src="img/mie.jpg" alt="Watermelon Noodle" class="menu-card-img" />
            <h3 class="menu-card-title">Watermelon <br />Noodle</h3>
            <p class="menu-card-price">IDR 20K</p>
            <div class="order-box">
                <button class="minus-btn" type="button" onclick="updateQuantity('quantity1', -1)">-</button>
                <input type="number" value="0" id="quantity1" name="quantity_1" min="0" onchange="calculateTotal()" />
                <button class="plus-btn" type="button" onclick="updateQuantity('quantity1', 1)">+</button>
            </div>
        </div>

        <div class="menu-card" id="item2">
            <img src="img/jus.jpg" alt="Smoothie Watermelon" class="menu-card-img" />
            <h3 class="menu-card-title">Smoothie Watermelon</h3>
            <p class="menu-card-price">IDR 15K</p>
            <div class="order-box">
                <button class="minus-btn" type="button" onclick="updateQuantity('quantity2', -1)">-</button>
                <input type="number" value="0" id="quantity2" name="quantity_2" min="0" onchange="calculateTotal()" />
                <button class="plus-btn" type="button" onclick="updateQuantity('quantity2', 1)">+</button>
            </div>
        </div>
        </div>
        </div>
        </div>

        <div class="player-id-container">
        <div class="step-number">3</div>
        <h3>E-Mail</h2>
        <form action="" method="POST">
            <div class="input-wrapper">
                <input type="text" id="email" name="email" placeholder="E-Mail" required />
            </div>
        <p style="color:red;">*Email berfungsi untuk mengirimkan bukti pembelian!!!</p>
    </div>


                <!-- Total Display -->
                <div class="bayar">
                    <h4 class="total-text">Total: IDR <span id="overall-total">0</span></h4>
                </div>

                <!-- Pesan Button -->
                <button id="pay-btn" type="submit" onclick="return confirmOrder()">Pesan</button>
            </form>


</div>
    </section>
    <!-- Menu Section End -->

    <footer>
        <div class="credit">
            <p>Created by <a href="">WNS Admin</a>. | &copy; 2025.</p>
        </div>
    </footer>

    <script>
        feather.replace();

        function updateQuantity(id, delta) {
            const quantityInput = document.getElementById(id);
            let currentQuantity = parseInt(quantityInput.value);
            if (currentQuantity + delta >= 0) {
                quantityInput.value = currentQuantity + delta;
                calculateTotal();
            }
        }

        function calculateTotal() {
            const quantity1 = parseInt(document.getElementById('quantity1').value) || 0;
            const quantity2 = parseInt(document.getElementById('quantity2').value) || 0;

            const price1 = 20000;
            const price2 = 15000;
            const totalPrice = (quantity1 * price1) + (quantity2 * price2);

            // Update total di tampilan
            document.getElementById('overall-total').innerText = totalPrice.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            });

            // Update hidden input untuk dikirim ke form
            document.getElementById('hidden_quantity1').value = quantity1;
            document.getElementById('hidden_quantity2').value = quantity2;
            document.getElementById('total_price').value = totalPrice;
        }

        function confirmOrder() {
            return confirm("Apakah Anda Yakin?");
        }
    </script>

    <script>
        let progressBar = document.getElementById("progress");
        let progress = 0;
        
        function updateProgress() {
            progress += 10;
            progressBar.style.width = progress + "%";
            if (progress < 100) {
                setTimeout(updateProgress, 300); // Update tiap 300ms
            } else {
                document.body.classList.add("loaded");
                document.getElementById("content").style.display = "block";
            }
        }

        window.onload = function () {
            updateProgress();
        };
        
    </script>
    <script>
  document.addEventListener('DOMContentLoaded', function () {
    const filterInput = (id) => {
      const input = document.getElementById(id);
      if (input) {
        input.addEventListener('input', function () {
          this.value = this.value.replace(/[<>]/g, '');
        });
      }
    };

    // Terapkan ke masing-masing input
    filterInput('namaplg');
    filterInput('notelpplg');
    filterInput('email');
  });
</script>

</body>
</html>
