<?php
session_start();
if (!isset($_SESSION['namauser'])) {
    header('Location: /login');
    exit;
}

// Set timeout duration (30 menit)
$timeout_duration = 1800; // 1800 detik = 30 menit

// Cek apakah sesi masih aktif
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    // Jika sesi lebih lama dari timeout, hapus sesi dan arahkan ke login
    session_unset();
    session_destroy();
    header('Location: login.php'); // Redirect ke login
    exit;
}

$_SESSION['LAST_ACTIVITY'] = time(); // Memperbarui waktu aktivitas terakhir

// Koneksi ke database
include 'db/conn.php';
include 'db/log_tracker.php';

// Ambil status yang dipilih
$selectedStatus = isset($_GET['status']) ? $_GET['status'] : 'All';

// Query untuk mengambil data dari tabel orders
$query = "SELECT order_id, namaplg, notelpplg, quantity_1, quantity_2, total_price, order_date, status FROM orders";

// Tambahkan kondisi jika status tidak "All"
if ($selectedStatus != 'All') {
    $query .= " WHERE status = '$selectedStatus'";
}

// Tambahkan pengurutan
$query .= " ORDER BY order_date ASC, order_id ASC";

$result = mysqli_query($conn, $query);

// Query untuk menghitung total pesanan
$total_query = "SELECT SUM(quantity_1) AS total_noodle, SUM(quantity_2) AS total_smoothie FROM orders";
if ($selectedStatus != 'All') {
    $total_query .= " WHERE status = '$selectedStatus'";
}

$total_result = mysqli_query($conn, $total_query);
$total_row = mysqli_fetch_assoc($total_result);

$total_noodle = $total_row['total_noodle'] ?? 0;
$total_smoothie = $total_row['total_smoothie'] ?? 0;

// Query untuk menghitung pesanan yang selesai
$completed_query = "SELECT 
    SUM(quantity_1) AS completed_noodle, 
    SUM(quantity_2) AS completed_smoothie 
    FROM orders WHERE status = 'Selesai'";
$completed_result = mysqli_query($conn, $completed_query);
$completed_row = mysqli_fetch_assoc($completed_result);

$completed_noodle = $completed_row['completed_noodle'] ?? 0;
$completed_smoothie = $completed_row['completed_smoothie'] ?? 0;

// Hitung pesanan yang masih pending
$pending_noodle = $total_noodle - $completed_noodle;
$pending_smoothie = $total_smoothie - $completed_smoothie;

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
    .orderan p {
      font-size: 18px; /* Ukuran font */
      color: white; /* Warna teks */
      text-align: center; /* Rata tengah */
      margin-bottom: 20px; /* Margin bawah */
      margin-top: 10rem; /* Margin atas */
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
    padding: 10px 20px;
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

#chart-container {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 40px;
  flex-wrap: wrap;
  padding: 2rem;
}

#chart-container canvas {
  width: 450px !important;
  height: 600px !important;
  max-width: 100%;
  max-height: 100%;
  background-color: none;
  border-radius: 10px;
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
    }
    
    #chart-container {
        padding: 0.5rem;
        margin-bottom: 50rem;
    }

    #chart-container canvas {
        width: 450px !important;
        height: 450px !important;
    }

    
    }

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

        #chart-container {
        padding: 0.5rem;
        margin-bottom: 20rem;
        }

        #chart-container canvas {
        width: 300px !important;
        height: 300px !important;
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
        <a href="/admin_etalase.php">Etalase</a>
    </div>

      <form action="">
        <div class="navbar-extra">
          <!-- <div id="search-box" class="searchbox hidden">
            <input type="text" placeholder=" Search..." id="search-input" />
          </div> 
          <a href="#" id="search-icon"><i data-feather="search"></i></a>
          <a href="/shops" id="shopping-cart"><i data-feather="shopping-cart"></i></a> -->
          <a href="/logout""
            ><i data-feather="home"></i
          ></a>
        <!--  <a href="#" id="menu"><i data-feather="menu"></i></a> -->
        </div>
      </form>
    </nav>
    <!-- Navbar End -->

    <!-- Menu Section Start -->






    <section id="orderan" class="orderan">
    <h2 style="text-align: center; margin-bottom: 20px; margin-top: 11rem; font-size: 2.6rem;">Daftar Pesanan Pelanggan</h2>

    <!-- Pilihan Filter Status -->
    <div style="text-align: center; margin-bottom: 20px;">
        <label for="filter-status" style="font-size: 1.2rem; color: white;">Status: </label>
        <select id="filter-status" style="padding: 5px; font-size: 1.1rem; border-radius: 5px;">
            <option value="All" <?php echo ($selectedStatus == 'All') ? 'selected' : ''; ?>>Semua</option>
            <option value="Pending" <?php echo ($selectedStatus == 'Pending') ? 'selected' : ''; ?>>Belum Selesai</option>
            <option value="Selesai" <?php echo ($selectedStatus == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
        </select>
    </div>


    <div class="order-cards-container">
<?php while ($row = mysqli_fetch_assoc($result)): ?>
<div class="order-card" data-status="<?php echo $row['status']; ?>" style="margin-button= 1rem;">
    <div class="order-circle" style="background-color: <?php echo ($row['status'] == 'Pending') ? 'red' : 'green'; ?>;">
        <?php echo $row['order_id']; ?>
    </div>
    <div class="order-details">
        <p>Nama Pelanggan: <?php echo $row['namaplg']; ?></p>
        <p>No. Pelanggan: <?php echo $row['notelpplg']; ?></p>
        <p>=====================</p>
        <p>Watermelon Noodle: <?php echo $row['quantity_1']; ?></p>
        <p>Smoothie Watermelon: <?php echo $row['quantity_2']; ?></p>
        <p>=====================</p>
        <p>Total Harga: IDR <?php echo number_format($row['total_price'], 0, ',', '.'); ?></p>
        <p>Tanggal Order: <?php echo $row['order_date']; ?></p>

        <!-- Tombol Selesai -->
        <form action="db/update_order_status.php" method="get" onsubmit="return confirm('Apakah Anda yakin ingin menyelesaikan pesanan ini?');">
    <!-- Setiap tombol harus memiliki order_id yang terkait -->
    <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
    
    <!-- Tambahkan hidden input untuk menyimpan status yang dipilih -->
    <input type="hidden" name="status" value="<?php echo $selectedStatus; ?>">
    
    <?php if ($row['status'] == 'Pending'): ?>
        <!-- Tombol Merah untuk pesanan yang statusnya 'Pending' -->
        <button type="submit" style="background-color: red; color: white; padding: 10px; border: none; cursor: pointer; width: 100%;">
            Belum Selesai
        </button>
    <?php else: ?>
        <!-- Tombol Hijau jika sudah selesai -->
        <button type="button" style="background-color: green; color: white; padding: 10px; border: none; cursor: default; width: 100%;">
            Selesai
        </button>
    <?php endif; ?>

</form>
    <!-- Tombol Chat WhatsApp -->
<a href="https://wa.me/62<?php echo ltrim($row['notelpplg'], '0'); ?>" target="_blank">
    <button style="background-color: #25D366; color: white; padding: 10px; border: none; border-radius: 5px; margin-top: 10px; width: 100%;">
        Chat WhatsApp
    </button>
</a>
    </div>
</div>
<?php endwhile; ?>
    </div>
    </section>

    <section id="total-menu" class="total-menu">
        <h2 style="margin-bottom: 0px; margin-top: 8rem;">-------------------------------------------</h2>
        <h2 style="text-align: center; font-size: 2.6rem;">Total Menu</h2>

        <div class="menu-summary-container">
            <!-- Box untuk Watermelon Noodle -->
            <div class="menu-summary-box">
                <p style="text-align: center; margin-top: 10px;">Watermelon Noodle <br />
                <span style="font-weight: bold; font-size: 1.5rem;"><?php echo $total_noodle; ?></span></p>
            </div>

            <!-- Box untuk Smoothie Watermelon -->
            <div class="menu-summary-box">
                <p style="text-align: center; margin-top: 10px;">Smoothie Watermelon <br />
                <span style="font-weight: bold; font-size: 1.5rem;"><?php echo $total_smoothie; ?></span></p>
            </div>
        </div>
    <h2 style="margin-bottom: 0px; margin-top: 1rem;">-------------------------------------------</h2>
    <h2 style="color: white;">Perbandingan Pesanan</h2>
        
        <!-- Chart Section -->
<section id="chart-container" style="text-align: center; margin-top: 50px; width: 100%; height: 500px; justify-content: center; display: flex;">
    <!-- Chart for Watermelon Noodles -->
    <canvas id="orderChartNoodle" width="1000" height="1000" >Watermelon Noodles</canvas>
    <!-- Chart for Smoothie Watermelon -->
    <canvas id="orderChartSmoothie" width="1000" height="1000" >Smoothie Watermelon</canvas>
</section>



    <?php mysqli_close($conn); // Tutup koneksi database ?>







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

      // Filter berdasarkan status
      document.getElementById('filter-status').addEventListener('change', function () {
        const selectedStatus = this.value;
        const orders = document.querySelectorAll('.order-card');

        orders.forEach(order => {
          const orderStatus = order.getAttribute('data-status');
          
          if (selectedStatus === 'All' || orderStatus === selectedStatus) {
            order.style.display = 'block';
          } else {
            order.style.display = 'none';
          }
        });
      });

      // Filter berdasarkan status
        document.getElementById('filter-status').addEventListener('change', function () {
            const selectedStatus = this.value;
            const url = new URL(window.location.href);
            url.searchParams.set('status', selectedStatus);
            window.location.href = url; // Redirect dengan status di URL
        });

    </script>

    <!-- Load Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>



<script>


// Data dari PHP
const dataNoodle = {
    total: <?php echo $total_noodle; ?>,
    completed: <?php echo $completed_noodle; ?>,
    pending: <?php echo $pending_noodle; ?>
};

const dataSmoothie = {
    total: <?php echo $total_smoothie; ?>,
    completed: <?php echo $completed_smoothie; ?>,
    pending: <?php echo $pending_smoothie; ?>
};

const centerTextPlugin = {
    id: 'centerText',
    beforeDraw(chart, args, options) {
        const { width, height, ctx } = chart;
        ctx.save();
        ctx.font = `bold ${(height / 30).toFixed(2)}px sans-serif`;
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillStyle = 'white';

        const text = options.text || '';
        const offsetY = 15; 
        ctx.fillText(text, width / 2, height / 2 + offsetY);
        ctx.restore();
    }
};



// Watermelon Noodle Chart
const ctxNoodle = document.getElementById('orderChartNoodle').getContext('2d');
const orderChartNoodle = new Chart(ctxNoodle, {
    type: 'doughnut',
    data: {
        labels: ['Selesai', 'Belum Selesai'],
        datasets: [{
            label: 'Watermelon Noodle',
            data: [dataNoodle.completed, dataNoodle.pending],
            backgroundColor: ['green', 'red'],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
                labels: {
                    color: 'white' // opsional, untuk background gelap
                }
            },
            centerText: {
                text: 'Watermelon Noodle'
            }
        }
    },
    plugins: [centerTextPlugin]
});

// Smoothie Watermelon Chart
const ctxSmoothie = document.getElementById('orderChartSmoothie').getContext('2d');
const orderChartSmoothie = new Chart(ctxSmoothie, {
    type: 'doughnut',
    data: {
        labels: ['Selesai', 'Belum Selesai'],
        datasets: [{
            label: 'Smoothie Watermelon',
            data: [dataSmoothie.completed, dataSmoothie.pending],
            backgroundColor: ['blue', 'orange'],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
                labels: {
                    color: 'white'
                }
            },
            centerText: {
                text: 'Smoothie Watermelon'
            }
        }
    },
    plugins: [centerTextPlugin]
});
</script>

<script>
// Data dari PHP
const totalNoodle = <?php echo $total_noodle; ?>;
const completedNoodle = <?php echo $completed_noodle; ?>;
const pendingNoodle = totalNoodle - completedNoodle;

const totalSmoothie = <?php echo $total_smoothie; ?>;
const completedSmoothie = <?php echo $completed_smoothie; ?>;
const pendingSmoothie = totalSmoothie - completedSmoothie;

const noodleChart = new Chart(document.getElementById('orderChartNoodle'), {
    type: 'doughnut',
    data: {
        labels: ['Selesai', 'Pending'],
        datasets: [{
            label: 'Watermelon Noodle',
            data: [completedNoodle, pendingNoodle],
            backgroundColor: ['#4CAF50', '#F44336'],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Pesanan Watermelon Noodle',
                font: {
                    size: 20
                }
            },
            tooltip: {
                callbacks: {
                    label: function (context) {
                        let value = context.parsed;
                        let total = context.dataset.data.reduce((a, b) => a + b, 0);
                        let percentage = ((value / total) * 100).toFixed(1) + '%';
                        return context.label + ': ' + value + ' (' + percentage + ')';
                    }
                }
            },
            datalabels: {
                formatter: (value, ctx) => {
                    const total = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                    return ((value / total) * 100).toFixed(1) + '%';
                },
                color: '#fff',
                font: {
                    weight: 'bold',
                    size: 16
                }
            }
        }
    },
    plugins: [ChartDataLabels]
});

const smoothieChart = new Chart(document.getElementById('orderChartSmoothie'), {
    type: 'doughnut',
    data: {
        labels: ['Selesai', 'Pending'],
        datasets: [{
            label: 'Smoothie Watermelon',
            data: [completedSmoothie, pendingSmoothie],
            backgroundColor: ['#2196F3', '#FFC107'],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Pesanan Smoothie Watermelon',
                font: {
                    size: 20
                }
            },
            tooltip: {
                callbacks: {
                    label: function (context) {
                        let value = context.parsed;
                        let total = context.dataset.data.reduce((a, b) => a + b, 0);
                        let percentage = ((value / total) * 100).toFixed(1) + '%';
                        return context.label + ': ' + value + ' (' + percentage + ')';
                    }
                }
            },
            datalabels: {
                formatter: (value, ctx) => {
                    const total = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                    return ((value / total) * 100).toFixed(1) + '%';
                },
                color: '#fff',
                font: {
                    weight: 'bold',
                    size: 16
                }
            }
        }
    },
    plugins: [ChartDataLabels]
});
</script>

</body>
</html>
