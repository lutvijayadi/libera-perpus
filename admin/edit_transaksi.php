<?php
include '../config/koneksi.php';

if (!isset($_GET['id_transaksi'])) {
    echo "ID Transaksi tidak ditemukan!";
    exit;
}

$id = $_GET['id_transaksi'];

// Ambil data transaksi
$query = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_transaksi = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data transaksi tidak ditemukan!";
    exit;
}

// Ambil data pendukung untuk dropdown
$query_users = mysqli_query($koneksi, "SELECT id_users, nama FROM users");
$query_buku = mysqli_query($koneksi, "SELECT id_buku, judul_buku FROM buku");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libera - Edit Transaksi</title>
    <link rel="stylesheet" href="../public/src/output.css">
</head>

<body class="bg-[#B0FFFA] font-poppins min-h-screen flex items-center justify-center p-4">

    <div class="relative z-10 w-full max-w-lg bg-white/90 backdrop-blur-md rounded-2xl shadow-xl overflow-hidden">

        <div class="bg-linear-to-r from-blue-600 to-blue-500 p-5 text-white flex items-center gap-3">
            <img src="../resources/img/baca_buku.png" class="w-6 h-6 brightness-0 invert">
            <h2 class="text-lg font-semibold tracking-wide">Edit Detail Transaksi</h2>
        </div>

        <div class="p-6">
            <form action="../aksi/aksi_edit_transaksi.php" method="post" class="space-y-4">

                <input type="hidden" name="id_transaksi" value="<?= $data['id_transaksi']; ?>">

                <div>
                    <label class="text-sm font-medium flex items-center gap-2 mb-1.5 text-gray-700">
                        <img src="../resources/img/anggota.png" class="w-4 h-4"> Nama Peminjam
                    </label>
                    <select name="id_users" required
                        class="w-full p-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none transition-all bg-white text-sm">
                        <option value="">Pilih User</option>
                        <?php while ($user = mysqli_fetch_assoc($query_users)) { ?>
                            <option value="<?= $user['id_users']; ?>" <?= ($user['id_users'] == $data['id_users']) ? 'selected' : ''; ?>>
                                <?= $user['nama']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div>
                    <label class="text-sm font-medium flex items-center gap-2 mb-1.5 text-gray-700">
                        <img src="../resources/img/buku.png" class="w-4 h-4"> Judul Buku
                    </label>
                    <select name="id_buku" required
                        class="w-full p-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none transition-all bg-white text-sm">
                        <option value="">Pilih Buku</option>
                        <?php while ($buku = mysqli_fetch_assoc($query_buku)) { ?>
                            <option value="<?= $buku['id_buku']; ?>" <?= ($buku['id_buku'] == $data['id_buku']) ? 'selected' : ''; ?>>
                                <?= $buku['judul_buku']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium flex items-center gap-2 mb-1.5 text-gray-700">
                            <img src="../resources/img/kalender.png" class="w-4 h-4"> Tgl Pinjam
                        </label>
                        <input type="date" name="tanggal_pinjam" value="<?= $data['tanggal_pinjam']; ?>" required
                            class="w-full p-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-400 outline-none text-sm">
                    </div>

                    <div>
                        <label class="text-sm font-medium flex items-center gap-2 mb-1.5 text-gray-700">
                            <img src="../resources/img/kalender.png" class="w-4 h-4"> Tgl Kembali
                        </label>
                        <input type="date" name="tanggal_kembali" value="<?= $data['tanggal_kembali']; ?>" required
                            class="w-full p-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-400 outline-none text-sm">
                    </div>
                </div>

                <div>
                    <label class="text-sm font-medium flex items-center gap-2 mb-1.5 text-gray-700">
                        <img src="../resources/img/status.png" class="w-4 h-4"> Status Transaksi
                    </label>
                    <select name="status" required
                        class="w-full p-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-400 outline-none bg-white text-sm">
                        <option value="menunggu konfirmasi" <?= ($data['status'] == 'menunggu konfirmasi') ? 'selected' : ''; ?>>Menunggu Konfirmasi</option>
                        <option value="disetujui" <?= ($data['status'] == 'disetujui') ? 'selected' : ''; ?>>Disetujui
                        </option>
                        <option value="ditolak" <?= ($data['status'] == 'ditolak') ? 'selected' : ''; ?>>Ditolak</option>
                        <option value="selesai" <?= ($data['status'] == 'selesai') ? 'selected' : ''; ?>>Selesai
                            (Dikembalikan)</option>
                    </select>
                </div>

                <div class="flex gap-3 pt-4">
                    <a href="transaksi.php"
                        class="flex-1 text-center border-2 border-blue-300 text-blue-600 py-3 rounded-xl hover:bg-gray-100 transition font-medium text-sm">
                        Batal
                    </a>
                    <button type="submit" name="edit"
                        class="flex-2 bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-200 font-semibold text-sm">
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>

</body>

</html>