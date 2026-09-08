<?php
session_start();
if(!isset($_SESSION['namauser'])) 
    {
    echo "<script>alert('Maaf Akses Ditolak Anda Belum Login..!!'); javascript:history.go(-1)</script>";
    include_once "index.php";
    exit;
    }
?>
