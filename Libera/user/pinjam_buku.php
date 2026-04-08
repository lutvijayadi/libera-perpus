<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['id_users'])) {
    echo "Silakan login dulu!";
    exit;
}

$id_users = $_SESSION['id_users'];

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID buku tidak ditemukan!";
    exit;
}

$id_buku = $_GET['id'];

// ambil user
$query_user = mysqli_query($koneksi, "SELECT * FROM users WHERE id_users='$id_users'");
$user = mysqli_fetch_assoc($query_user);

if (!$user) {
    die("User tidak ditemukan!");
}

// ambil buku
$query_buku = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku='$id_buku'");
$buku = mysqli_fetch_assoc($query_buku);

if (!$buku) {
    echo "Buku tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Pinjam Buku</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#B0FFFA] flex justify-center items-center min-h-screen">

<div class="bg-white p-6 rounded-xl shadow w-full max-w-md">

<h2 class="text-lg font-bold mb-4">Form Peminjaman Buku</h2>

<p><b>Nama:</b> <?= $user['nama'] ?: 'Belum ada nama'; ?></p>
<p><b>Buku:</b> <?= $buku['judul_buku']; ?></p>
<p><b>Stok:</b> <?= $buku['stok']; ?></p>

<form action="../aksi/aksi_peminjaman_buku.php" method="post" class="mt-4 space-y-3">

<input type="hidden" name="id_buku" value="<?= $buku['id_buku']; ?>">

<input type="date" name="tanggal_pinjam" required class="w-full border p-2">
<input type="date" name="tanggal_kembali" required class="w-full border p-2">
<input type="number" name="total_pinjam" min="1" required class="w-full border p-2">

<button class="bg-blue-600 text-white px-4 py-2 rounded w-full">
Pinjam Buku
</button>

</form>

</div>

</body>
</html>