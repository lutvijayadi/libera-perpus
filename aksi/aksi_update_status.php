<?php
session_start();
include '../config/koneksi.php';
if (!isset($_SESSION['id_users'])) {
    header("Location: ../auth/login.php");
    exit;
}

// ambil data dari form
$id_transaksi = $_POST['id_transaksi'];
$status = strtolower($_POST['action']); 

if (!in_array($status, ['disetujui', 'ditolak'])) {
    die("Status tidak valid!");
}

// ambil data transaksi + buku
$query = mysqli_query($koneksi, "
    SELECT transaksi.*, buku.judul_buku 
    FROM transaksi 
    JOIN buku ON transaksi.id_buku = buku.id_buku
    WHERE id_transaksi = '$id_transaksi'
");

$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}

$id_buku = $data['id_buku'];
$total_pinjam = $data['total_pinjam'];
$judul = $data['judul_buku'];


mysqli_query($koneksi, "
    UPDATE transaksi 
    SET status='$status' 
    WHERE id_transaksi='$id_transaksi'
");


if ($status == "Ditolak") {
    mysqli_query($koneksi, "
        UPDATE buku 
        SET stok = stok + $total_pinjam 
        WHERE id_buku='$id_buku'
    ");
}


$message = "Peminjaman buku $judul telah $status.";
$message = mysqli_real_escape_string($koneksi, $message);

mysqli_query($koneksi, "
    INSERT INTO notif (id_transaksi, message) 
    VALUES ('$id_transaksi', '$message')
");


header("Location: ../admin/transaksi.php");
exit;
?>