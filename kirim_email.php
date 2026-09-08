<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Ambil data dari POST (bukan GET)
$order_id = $_POST['order_id'] ?? 'N/A';
$namaplg = $_POST['namaplg'] ?? 'N/A';
$quantity_1 = $_POST['quantity_1'] ?? 0;
$quantity_2 = $_POST['quantity_2'] ?? 0;
$total_price = $_POST['total_price'] ?? 0;
$order_date = $_POST['order_date'] ?? 'N/A';
$email_pelanggan = $_POST['email'] ?? '';


// Pastikan email pelanggan terisi
if (empty($email_pelanggan)) {
    die("Email pelanggan tidak boleh kosong!");
}

$mail = new PHPMailer(true);

try {
    // Konfigurasi SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'wns.shops.pku@gmail.com';
    $mail->Password   = 'mvvylrpcnjprtkmj';  // Ganti dengan kredensial yang benar
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Pengirim dan penerima
    $mail->setFrom('wns.shops.pku@gmail.com', 'WNS Shop');
    $mail->addAddress($email_pelanggan, $namaplg);
    $mail->addReplyTo('no-reply@wns.com', 'No Reply');

    // Format email
    $mail->isHTML(true);
    $mail->Subject = 'Struk Pembelian - WNS Shop';
    $mail->Body    = "
        <div style='border:1px solid #fff; padding:15px; border-radius:10px; max-width:400px; text-align:center; font-family:Arial,sans-serif;'>
            <h2 style='color:green;'><i>WN<span style='color:red;'>S</span></i>.</h2>
            <h3>Struk Pembayaran</h3>
            <p><strong>ID Pesanan:</strong> {$order_id}</p>
            <p><strong>Nama Pelanggan:</strong> {$namaplg}</p>
            <p><strong>Tanggal Pesanan:</strong> {$order_date}</p>
            <hr>
            <p><strong>Watermelon Noodle:</strong> {$quantity_1} x IDR 20.000</p>
            <p><strong>Smoothie Watermelon:</strong> {$quantity_2} x IDR 15.000</p>
            <hr>
            <h3>Total Harga: IDR {$total_price}</h3>
            <p style='margin-top:20px;'>Terima kasih telah berbelanja di WNS Shop!</p>
        </div>
    ";

    $mail->send();
    echo 'Success';
} catch (Exception $e) {
    echo "Gagal mengirim email: {$mail->ErrorInfo}";
}