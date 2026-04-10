<?php
session_start();
include '../config/koneksi.php';

$id_transaksi = $_POST['id_transaksi'];
$tanggal_kembali = $_POST['tanggal_kembali'];

// ambil data transaksi
$query = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_transaksi='$id_transaksi'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Transaksi tidak ditemukan!");
}

$id_buku = $data['id_buku'];
$total_pinjam = $data['total_pinjam'];

// 1. update status transaksi
mysqli_query($koneksi, "UPDATE transaksi 
SET status='selesai', tanggal_kembali='$tanggal_kembali'
WHERE id_transaksi='$id_transaksi'");

// 2. kembalikan stok buku
mysqli_query($koneksi, "UPDATE buku 
SET stok = stok + $total_pinjam 
WHERE id_buku='$id_buku'");

// 3. notif (optional)
$message = "Buku ".$data['judul_buku']." telah dikembalikan.";
$message = mysqli_real_escape_string($koneksi, $message);

mysqli_query($koneksi, "INSERT INTO notif (id_transaksi, message) 
VALUES ('$id_transaksi', '$message')");

echo "<script>alert('Buku berhasil dikembalikan');window.location='../user/dashboard_user.php';</script>";
?>