<?php
include '../config/koneksi.php';

if (isset($_POST['action'])) {
    $id = $_POST['id_transaksi'];
    $status_baru = strtolower($_POST['action']); // penting!

    // Update status transaksi
    $query = "UPDATE transaksi SET status = '$status_baru' WHERE id_transaksi = '$id'";
    
    if (mysqli_query($koneksi, $query)) {

        // ✅ HAPUS NOTIF OTOMATIS
        mysqli_query($koneksi, "DELETE FROM notif WHERE id_transaksi = '$id'");
        
        header("Location: ../admin/transaksi.php?pesan=update_berhasil");
        exit;

    } else {
        echo "Gagal update: " . mysqli_error($koneksi);
    }
}
?>