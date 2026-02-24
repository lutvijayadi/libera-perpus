<?php

include '../config/koneksi.php';

if (isset($_POST['kembalikan'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $judul_buku = mysqli_real_escape_string($koneksi, $_POST['judul_buku']);

    $query = "UPDATE peminjaman SET status='kembali' WHERE nama='$nama' AND judul_buku='$judul_buku' AND status='dipinjam'";
    if (mysqli_query($koneksi, $query)) {
        // Create notif table if not exists
        $create_notif_table = "CREATE TABLE IF NOT EXISTS notif (
            id_notif INT AUTO_INCREMENT PRIMARY KEY,
            message TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        mysqli_query($koneksi, $create_notif_table);

        // Insert notification for admin
        $message = "User $nama mengembalikan buku '$judul_buku'.";
        $query_notif = "INSERT INTO notif (message) VALUES ('$message')";

        if (mysqli_query($koneksi, $query_notif)) {
            header("Location: ../user/pengembalian_buku.php?pesan=berhasil_kembali");
            exit();
        } else {
            echo "Gagal membuat notifikasi: " . mysqli_error($koneksi);
        }
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    header("Location: ../user/pengembalian_buku.php");
}