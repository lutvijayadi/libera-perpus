<?php
session_start();
include '../config/koneksi.php';

// cek login
if (!isset($_SESSION['id_users'])) {
    header("Location: ../auth/login.php");
    exit;
}

// ambil dari SESSION (AMAN)
$id_users = $_SESSION['id_users'];

$id_buku = $_POST['id_buku'];
$tanggal_pinjam = $_POST['tanggal_pinjam'];
$tanggal_kembali = $_POST['tanggal_kembali'];
$total_pinjam = $_POST['total_pinjam'];

// cek stok
$cek = mysqli_query($koneksi, "SELECT stok, judul_buku FROM buku WHERE id_buku='$id_buku'");
$data_buku = mysqli_fetch_assoc($cek);

if ($data_buku['stok'] < $total_pinjam) {
    echo "<script>alert('Stok tidak cukup!');history.back();</script>";
    exit;
}

// ambil data user
$user_q = mysqli_query($koneksi, "SELECT nama FROM users WHERE id_users='$id_users'");
$data_user = mysqli_fetch_assoc($user_q);

// ambil nama & judul
$nama = $data_user['nama'] ?? 'User';
$judul = $data_buku['judul_buku'] ?? 'Buku';

// INSERT TRANSAKSI (SUDAH LENGKAP)
$query = mysqli_query($koneksi, "INSERT INTO transaksi 
(id_users, nama, judul_buku, id_buku, tanggal_pinjam, tanggal_kembali, status, total_pinjam)
VALUES 
('$id_users', '$nama', '$judul', '$id_buku', '$tanggal_pinjam', '$tanggal_kembali', 'menunggu konfirmasi', '$total_pinjam')");

if ($query) {

    $id_transaksi = mysqli_insert_id($koneksi);

    // notif
    $message = "$nama meminjam buku $judul sebanyak $total_pinjam buku.";
    $message = mysqli_real_escape_string($koneksi, $message);

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