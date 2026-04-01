<?php
include '../config/koneksi.php';

if (isset($_POST['action'])) {
    $id = $_POST['id_transaksi'];
    $status_baru = $_POST['action'];

    // Update status di tabel transaksi
    $query = "UPDATE transaksi SET status = '$status_baru' WHERE id_transaksi = '$id'";
    
    if (mysqli_query($koneksi, $query)) {
        // Opsional: Hapus notifikasi jika sudah diproses agar tidak menumpuk
        // mysqli_query($koneksi, "DELETE FROM notif WHERE id_transaksi = '$id'");
        
        header("Location: dashboard_admin.php?pesan=update_berhasil");
    } else {
        echo "Gagal update: " . mysqli_error($koneksi);
    }
}