<?php
session_start();
include '../config/koneksi.php';

// cek login
if (!isset($_SESSION['id_users'])) {
    header("Location: ../auth/login.php");
    exit;
}

// ambil data dari form
$id_users = $_POST['id_users'];
$id_buku = $_POST['id_buku'];
$tanggal_pinjam = $_POST['tanggal_pinjam'];
$tanggal_kembali = $_POST['tanggal_kembali'];
$total_pinjam = $_POST['total_pinjam'];

// cek stok buku
$cek = mysqli_query($koneksi, "SELECT stok FROM buku WHERE id_buku='$id_buku'");
$data = mysqli_fetch_assoc($cek);

if ($data['stok'] < $total_pinjam) {
    echo "<script>alert('Stok tidak cukup!');history.back();</script>";
    exit;
}

// insert transaksi
$query = mysqli_query($koneksi, "INSERT INTO transaksi 
(id_users, id_buku, tanggal_pinjam, tanggal_kembali, status, total_pinjam)
VALUES 
('$id_users', '$id_buku', '$tanggal_pinjam', '$tanggal_kembali', 'dipinjam', '$total_pinjam')");

if ($query) {

    // ambil id transaksi terakhir
    $id_transaksi = mysqli_insert_id($koneksi);

    // ambil nama user
    $user_q = mysqli_query($koneksi, "SELECT nama FROM users WHERE id_users='$id_users'");
    $user_d = mysqli_fetch_assoc($user_q);

    // ambil judul buku
    $buku_q = mysqli_query($koneksi, "SELECT judul_buku FROM buku WHERE id_buku='$id_buku'");
    $buku_d = mysqli_fetch_assoc($buku_q);

    $nama = $user_d['nama'];
    $judul = $buku_d['judul_buku'];

    // buat pesan notif (TANPA PETIK DALAM STRING)
    $message = "$nama meminjam buku $judul sebanyak $total_pinjam buku.";

    // amankan string
    $message = mysqli_real_escape_string($koneksi, $message);

    // insert ke tabel notif
    mysqli_query($koneksi, "INSERT INTO notif (id_transaksi, message) 
    VALUES ('$id_transaksi', '$message')");

    // kurangi stok
    mysqli_query($koneksi, "UPDATE buku 
    SET stok = stok - $total_pinjam 
    WHERE id_buku='$id_buku'");

    echo "<script>alert('Berhasil pinjam buku');window.location='../user/dashboard_user.php';</script>";
} else {
    echo "Gagal: " . mysqli_error($koneksi);
}
?>