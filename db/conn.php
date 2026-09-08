<?php
include "parser-php-version.php";
$host = "localhost";
$user = "root";
$pass = "";
$db = "dbwns";

// Membuat koneksi menggunakan mysqli
$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }

// echo "Connected successfully";
?>