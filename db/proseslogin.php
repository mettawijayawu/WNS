<?php
session_start();
include "conn.php";

// Mengambil input user
$a = $_REQUEST['user1'];
$b = $_REQUEST['pass2'];

// Validasi input user
if (empty($a)) {
    echo "<script>alert('Maaf, Anda harus mengisi user'); window.history.back();</script>";
    exit();
}

if (empty($b)) {
    echo "<script>alert('Maaf, Anda harus mengisi password'); window.history.back();</script>";
    exit();
}

// Escape untuk mencegah SQL Injection
$a = mysqli_real_escape_string($conn, $a);
$b = mysqli_real_escape_string($conn, $b);

// Query untuk mengecek user
$query = mysqli_query($conn, "SELECT * FROM user_tb WHERE username='$a' AND password='$b'");

// Jika ditemukan user
if ($ketemu = mysqli_fetch_array($query)) {
    $_SESSION['namauser'] = $a;
    session_regenerate_id(true); // Regenerasi ID sesi untuk keamanan

    // Setelah login berhasil, arahkan ke halaman adminview.php
    echo "<script>alert('Selamat Datang..!!'); window.location.href = '../aview';</script>";
    exit();
} else {
    // Jika user tidak ditemukan
    echo "<script>alert('Maaf, user dan password tidak cocok'); window.history.back();</script>";
    exit();
}
?>
