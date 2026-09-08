<?php
// Ambil data dari form
$nama   = $_POST['nama'];
$produk = $_POST['produk'];
$no_hp  = $_POST['no_hp'];

// Format nomor HP
$no_hp = preg_replace('/^0/', '62', $no_hp); // ganti 08xxx jadi 628xxx

// Teks pesan
$pesan = "Halo $nama, terima kasih sudah memesan *$produk* di toko kami. Kami akan segera proses pesanan kamu 🙏";

// Kirim via API watsap.id
$api_key   = '1234566677'; // API Key kamu
$id_device = '12345'; // ID Device kamu
$url       = 'https://api.watsap.id/send-message';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
curl_setopt($curl, CURLOPT_TIMEOUT, 0);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_POST, 1);

$data_post = [
   'id_device' => $id_device,
   'api-key'   => $api_key,
   'no_hp'     => $no_hp,
   'pesan'     => $pesan
];
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data_post));
curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
$response = curl_exec($curl);
curl_close($curl);

echo "Pesan berhasil dikirim ke WhatsApp $no_hp";
?>
