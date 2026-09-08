<?php
// Koneksi ke database
include 'conn.php'; // Pastikan path ini sesuai

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $status = isset($_GET['status']) ? $_GET['status'] : 'All'; 

    // Update status menjadi 'Selesai' hanya untuk order_id yang diberikan
    $query = "UPDATE orders SET status = 'Selesai' WHERE order_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $order_id);
    // echo "order_id = $order_id";
    
    if ($stmt->execute()) {
        // Jika berhasil, redirect ke halaman aview.php
        header("Location: ../aview?status=$status"); 
        exit;
    } else {
        echo "Failed to update order status";
    }
} else {
    echo "No order ID provided";
}
?>
