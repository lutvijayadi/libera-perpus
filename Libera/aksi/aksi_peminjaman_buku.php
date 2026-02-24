<?php
session_start();

include '../config/koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php?pesan=belum_login");
    exit();
}

if (isset($_POST['pinjam'])) {

    $nama            = mysqli_real_escape_string($koneksi, $_SESSION['username']);
    $judul_buku      = mysqli_real_escape_string($koneksi, $_POST['judul_buku']);
    $tanggal_pinjam  = mysqli_real_escape_string($koneksi, $_POST['tanggal_pinjam']);
    $tanggal_kembali = mysqli_real_escape_string($koneksi, $_POST['tanggal_kembali']);
    $status          = mysqli_real_escape_string($koneksi, $_POST['status']);
    $total_pinjam    = mysqli_real_escape_string($koneksi, $_POST['total_pinjam']);

    // 1. Insert ke tabel transaksi
    $query_transaksi = "INSERT INTO transaksi (nama, judul_buku, tanggal_pinjam, tanggal_kembali, status) 
                        VALUES ('$nama', '$judul_buku', '$tanggal_pinjam', '$tanggal_kembali', '$status')";

    if (mysqli_query($koneksi, $query_transaksi)) {
        
        // tabel notif
        $create_notif_table = "CREATE TABLE IF NOT EXISTS notif (
            id_notif INT AUTO_INCREMENT PRIMARY KEY,
            message TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        mysqli_query($koneksi, $create_notif_table);

        // Insert notifikasi
        $message = "User $nama meminjam buku '$judul_buku' sebanyak $total_pinjam buku.";
        $escaped_message = mysqli_real_escape_string($koneksi, $message);
        
        $query_notif = "INSERT INTO notif (message) VALUES ('$escaped_message')";

        if (mysqli_query($koneksi, $query_notif)) {
            header("Location: ../user/dashboard_user.php?pesan=berhasil_pinjam");
            exit();
        } else {
            echo "Gagal membuat notifikasi: " . mysqli_error($koneksi);
        }
    } else {
        echo "Gagal meminjam buku: " . mysqli_error($koneksi);
    }
} else {
    header("Location: ../user/pinjam_buku.php");
    exit();
}
?>