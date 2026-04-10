<?php
include '../config/koneksi.php';

$id = $_GET['id'];

// ambil data transaksi
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT * FROM transaksi WHERE id_transaksi='$id'
"));

$id_buku = $data['id_buku'];
$total = $data['total_pinjam'];

// update status jadi selesai
mysqli_query($koneksi, "
    UPDATE transaksi SET status='selesai' WHERE id_transaksi='$id'
");

// kembalikan stok
mysqli_query($koneksi, "
    UPDATE buku SET stok = stok + $total WHERE id_buku='$id_buku'
");

header("Location: ../admin/transaksi.php");
exit;
?>