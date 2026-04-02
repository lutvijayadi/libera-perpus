<?php
session_start();
include '../config/koneksi.php';

// =======================
// CEK LOGIN
// =======================
if (!isset($_SESSION['id_users'])) {
    echo "Silakan login dulu!";
    exit;
}

$id_users = $_SESSION['id_users'];

// =======================
// CEK ID BUKU DARI URL
// =======================
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID buku tidak ditemukan!";
    exit;
}

$id_buku = $_GET['id'];

// =======================
// AMBIL DATA USER
// =======================
$query_user = mysqli_query($koneksi, "SELECT * FROM users WHERE id_users='$id_users'");
$user = mysqli_fetch_assoc($query_user);


$query_buku = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku='$id_buku'");

// debug kalau query error
if (!$query_buku) {
    die("Query error: " . mysqli_error($koneksi));
}

$buku = mysqli_fetch_assoc($query_buku);

// cek buku ada atau tidak
if (!$buku) {
    echo "Buku tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Pinjam Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-xl shadow">

        <h1 class="text-xl font-bold mb-4">Pinjam Buku</h1>

        <!-- INFO -->
        <div class="mb-4">
            <p><strong>Nama:</strong> <?= $user['nama']; ?></p>
            <p><strong>Judul Buku:</strong> <?= $buku['judul_buku']; ?></p>
            <p><strong>Stok:</strong> <?= $buku['stok']; ?></p>
        </div>

        <!-- FORM -->
        <form action="../aksi/aksi_peminjaman_buku.php" method="post">

            <!-- HIDDEN -->
            <input type="hidden" name="id_buku" value="<?= $buku['id_buku']; ?>">
            <input type="hidden" name="id_users" value="<?= $user['id_users']; ?>">

            <div class="mb-3">
                <label class="block text-sm">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" required class="w-full border p-2 rounded">
            </div>

            <div class="mb-3">
                <label class="block text-sm">Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" required class="w-full border p-2 rounded">
            </div>

            <div class="mb-3">
                <label class="block text-sm">Jumlah Pinjam</label>
                <input type="number" name="total_pinjam" min="1" required class="w-full border p-2 rounded">
            </div>

            <button type="submit" name="pinjam" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                Pinjam Buku
            </button>

        </form>

    </div>

</body>

</html>