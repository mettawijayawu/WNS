<?php
// Get order data from URL query parameters
$order_id = $_GET['order_id'] ?? 'N/A';
$namaplg = $_GET['namaplg'] ?? 'N/A';
$quantity_1 = $_GET['quantity_1'] ?? 0;
$quantity_2 = $_GET['quantity_2'] ?? 0;
$total_price = $_GET['total_price'] ?? 0;
$order_date = $_GET['order_date'] ?? 'N/A';

// Menu prices
$price1 = 20000;  // Watermelon Noodle
$price2 = 15000;  // Smoothie Watermelon

// Calculate total price
$total = ($quantity_1 * $price1) + ($quantity_2 * $price2);
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
        rel="stylesheet" />

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- My Style -->
    <link rel="stylesheet" href="css/style1.css" />
    <style>
    * {
        user-select: none;
    }

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
        justify-content: center;
        align-items: center;
        /* height: 100vh; */
        flex-direction: column;
    }

    .main-contents {
        margin-top: 100px;
        margin-bottom: 110px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }

    .receipt {
        max-width: 400px;
        margin: 0 auto;
        min-height: 100mm;
        margin-top: 20px;
        padding: 20px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .receipt h1 {
        text-align: center;
        font-size: 24px;
        margin-top: 10px;
        margin-bottom: 20px;
        color: black;
    }

    .receipt p {
        margin: 5px 0;
        font-size: 16px;
        color: black;
    }

    .receipt .total {
        font-weight: bold;
        font-size: 18px;
        margin-top: 20px;
        margin-button: 20px;
    }

    .footer-section {
        text-align: center;
        margin-top: 20px;
    }

    .print-btn {
        display: block;
        width: 100%;
        max-width: 200px;
        margin: 10px auto;
        padding: 10px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    .print-btn:hover {
        background-color: #218838;
    }

    .footers {
        text-align: center;
        font-size: 14px;
        color: black;
        margin-top: 10px;
    }

    .receipt .navbar-logo {
        display: block;
        /* Mengubah agar logo menjadi elemen block */
        font-size: 2rem;
        font-weight: 700;
        color: rgb(255, 0, 0);
        text-align: center;
        /* Memastikan teks rata tengah */
        font-style: italic;
        margin: 0 auto;
        /* Membantu posisi tengah */
        width: fit-content;
        /* Menyesuaikan lebar dengan teks */
    }


    .receipt .navbar-logo span {
        color: var(--primary);
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
        color: #fff;
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
        color: #fff;
        padding: 0.7rem 1rem;
    }

    footer .credit {
        font-size: 1.3rem;
    }

    footer .credit a {
        color: var(--bg);
        font-weight: 700;
    }

    /* @page {
  size: 80mm auto;
  margin: 5mm;
} */

    @media print {
        body {
            background: white !important;
            color: black !important;
            margin: 0;
            padding: 0;
        }

        .receipt {
            width: 100%;
            /* Memastikan lebar maksimal */
            max-width: 80mm;
            /* Menyesuaikan dengan ukuran struk */
            padding: 10px;
            font-size: 14px;
            /* Perbesar teks agar lebih terbaca */
            text-align: center;
            border: none;
        }

        .receipt h1 {
            font-size: 18px;
            /* Perbesar judul */
        }

        .receipt p {
            font-size: 14px;
            margin: 5px 0;
        }

        .print-btn {
            display: none !important;
        }
    }

    @media print {

        /* Gaya untuk print */
        .navbar,
        .footer,
        .no-print {
            display: none !important;
            /* Menyembunyikan elemen yang tidak ingin dicetak */
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
          <a href="#" id="search-icon"><i data-feather="search"></i></a> -->
                <a href="/shops" id="shopping-cart"><i data-feather="shopping-cart"></i></a>
                <a href="/home"><i data-feather="home"></i></a>
                <!-- <a href="#" id="menu"><i data-feather="menu"></i></a> -->
            </div>
        </form>
    </nav>
    <!-- Navbar End -->
    <div class="main-contents">
        <div class="receipt" id="receipt">
            <a href="/home" class="navbar-logo">WN<span>S.</span></a>
            <h1>Struk Pembayaran</h1>

            <p>
                <strong>ID Pesanan:</strong>
                <?php echo htmlspecialchars($order_id); ?>
            </p>
            <p>
                <strong>Nama Pelanggan:</strong>
                <?php echo htmlspecialchars($namaplg); ?>
            </p>
            <p>
                <strong>Tanggal Pesanan:</strong>
                <?php echo htmlspecialchars($order_date); ?>
            </p>

            <p> ============================== </p>

            <p>
                <strong>Watermelon Noodle:</strong>
                <?php echo htmlspecialchars($quantity_1); ?>
                x IDR
                <?php echo number_format($price1, 0, ',', '.'); ?>
            </p>
            <p>
                <strong>Smoothie Watermelon:</strong>
                <?php echo htmlspecialchars($quantity_2); ?>
                x IDR
                <?php echo number_format($price2, 0, ',', '.'); ?>
            </p>

            <p> ============================== </p>

            <p class="total">
                Total Harga: IDR
                <?php echo number_format($total, 0, ',', '.'); ?>
            </p>

            <!-- Button Cetak Struk dan Teks Terimakasih
    <div class="footer-section">
      <button class="print-btn" onclick="printReceipt()">Cetak Struk</button>
      <p class="footers">Terimakasih telah berbelanja di WNS!</p>
    </div> -->
            <div class="footer-section">
                <button class="print-btn" onclick="kirimStruk()">Kirim Struk</button>
                <p class="footers">Terimakasih telah berbelanja di WNS!</p>
            </div>
        </div>
    </div>

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

    <script>
    function printReceipt() {
        // Menonaktifkan elemen yang tidak diinginkan
        document.querySelector('footer').style.display = 'none';

        // Cetak halaman
        window.print();

        // Mengaktifkan elemen setelah pencetakan selesai
        document.querySelector('footer').style.display = 'block';
    }

    function kirimStruk() {
        // Ambil data order dari halaman
        let orderId = "<?php echo $order_id; ?>";
        let namaPelanggan = "<?php echo $namaplg; ?>";
        let quantity_1 = "<?php echo $quantity_1; ?>";
        let quantity_2 = "<?php echo $quantity_2; ?>";
        let total_price = "<?php echo $total_price; ?>";
        let order_date = "<?php echo $order_date; ?>";

        // Ambil email dari URL jika ada
        let urlParams = new URLSearchParams(window.location.search);
        let email = urlParams.get("email") || prompt("Masukkan email pelanggan:");

        if (email) {
            // Kirim data ke kirim_email.php via POST
            fetch("kirim_email.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: `order_id=${orderId}&namaplg=${namaPelanggan}&quantity_1=${quantity_1}&quantity_2=${quantity_2}&total_price=${total_price}&order_date=${order_date}&email=${email}`
                })
                .then(response => response.text())
                .then(data => {
                    alert("Struk telah dikirim!");
                    window.location.href = "/thanks"; // Redirect ke halaman shops
                })
                .catch(error => alert("Gagal mengirim struk: " + error));
        } else {
            alert("Email tidak boleh kosong!");
        }
    }
    </script>

</body>

</html>