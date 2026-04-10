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

<body class="bg-[#B0FFFA] from-blue-100 to-blue-300 min-h-screen flex items-center justify-center font-sans">

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden w-full max-w-4xl grid md:grid-cols-2">

        <!-- LEFT: INFO BUKU -->
        <div class="bg-blue-600 text-white p-6 flex flex-col justify-between">

            <div class="flex items-center gap-2 mb-2">
                <img src="../resources/img/buku.png" class="w-6 h-6">
                <h2 class="text-xl font-bold">Detail Buku</h2>
            </div>
            <p class="text-sm opacity-90">Pastikan data buku sebelum melakukan peminjaman</p>

            <!-- COVER -->
            <div class="mt-6 flex justify-center">
                <?php if (!empty($buku['cover'])) { ?>
                    <img src="../uploads/<?= $buku['cover']; ?>" class="w-40 h-56 object-cover rounded-xl shadow-lg">
                <?php } else { ?>
                    <div class="w-40 h-56 bg-white/20 flex items-center justify-center rounded-xl">
                        No Cover
                    </div>
                <?php } ?>
            </div>

            <!-- INFO -->
            <div class="mt-6 text-sm space-y-1">
                <p><b>Judul:</b> <?= $buku['judul_buku']; ?></p>
                <p><b>Pengarang:</b> <?= $buku['pengarang']; ?></p>
                <p><b>Stok:</b> <?= $buku['stok']; ?></p>
            </div>

        </div>

        <!-- RIGHT: FORM -->
        <div class="p-6">

            <h2 class="text-lg font-bold mb-4 text-gray-700">Form Peminjaman</h2>

            <!-- USER INFO -->
            <div class="bg-gray-100 p-3 rounded-lg mb-4 text-sm">
                <p><b>Nama:</b> <?= $user['nama'] ?: 'Belum ada nama'; ?></p>
            </div>

            <form action="../aksi/aksi_peminjaman_buku.php" method="post" class="space-y-4">

                <input type="hidden" name="id_buku" value="<?= $buku['id_buku']; ?>">

                <!-- TANGGAL PINJAM -->
                <div>
                    <label class="text-sm text-gray-600">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" required
                        class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none">
                </div>

                <!-- TANGGAL KEMBALI -->
                <div>
                    <label class="text-sm text-gray-600">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" required
                        class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- JUMLAH -->
                <div>
                    <label class="text-sm text-gray-600">Jumlah Pinjam</label>
                    <input type="number" name="total_pinjam" min="1" max="<?= $buku['stok']; ?>" required
                        class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                    <p class="text-xs text-gray-400 mt-1">Maksimal: <?= $buku['stok']; ?></p>
                </div>

                <!-- BUTTON -->
                <button
                    class="w-full bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 transition shadow-md hover:scale-105">
                    Pinjam Sekarang
                </button>

            </form>

        </div>

    </div>

</body>

</html>