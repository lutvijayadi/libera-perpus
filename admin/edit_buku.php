<?php
include '../config/koneksi.php';

// VALIDASI
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Data tidak ditemukan!";
    exit;
}

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <link rel="stylesheet" href="../public/src/output.css">

    <title>Edit Buku - Libera</title>
</head>

<body class=" bg-[#B0FFFA]  relative font-poppins min-h-screen flex items-center justify-center">

    <!-- CARD -->
    <div class="relative z-10 w-full max-w-xl bg-white/90 backdrop-blur-md rounded-2xl shadow-xl overflow-hidden">

        <!-- HEADER -->
        <div class="bg-linear-to-r from-[#2563eb] to-[#3b82f6] p-5 text-white flex items-center gap-3">
            <h2 class="text-lg font-semibold">Edit Data Buku</h2>
        </div>

        <!-- CONTENT -->
        <div class="p-6">

            <form action="../aksi/aksi_edit_buku.php" method="post" enctype="multipart/form-data" class="space-y-4">

                <input type="hidden" name="id_buku" value="<?= $data['id_buku']; ?>">

                <!-- JUDUL -->
                <div>
                    <label class="text-sm flex items-center gap-2 mb-1">
                        <img src="../resources/img/buku.png" class="w-4 h-4"> Judul Buku
                    </label>
                    <input type="text" name="judul_buku" value="<?= $data['judul_buku']; ?>" required
                        class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- PENGARANG & PENERBIT -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm flex items-center gap-2 mb-1">
                            <img src="../resources/img/pengarang.png" class="w-4 h-4"> Pengarang
                        </label>
                        <input type="text" name="pengarang" value="<?= $data['pengarang']; ?>" required
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                    </div>

                    <div>
                        <label class="text-sm flex items-center gap-2 mb-1">
                            <img src="../resources/img/penerbit.png" class="w-4 h-4"> Penerbit
                        </label>
                        <input type="text" name="penerbit" value="<?= $data['penerbit']; ?>" required
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                    </div>
                </div>

                <!-- TAHUN & STOK -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm flex items-center gap-2 mb-1">
                            <img src="../resources/img/kalender.png" class="w-4 h-4"> Tahun
                        </label>
                        <input type="number" name="tahun_terbit" value="<?= $data['tahun_terbit']; ?>" required
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                    </div>

                    <div>
                        <label class="text-sm flex items-center gap-2 mb-1">
                            <img src="../resources/img/stok.png" class="w-4 h-4"> Stok
                        </label>
                        <input type="number" name="stok" value="<?= $data['stok']; ?>" required
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                    </div>
                </div>

                <!-- COVER -->
                <div>
                    <label class="text-sm flex items-center gap-2 mb-2">
                        <img src="../resources/img/img.png" class="w-4 h-4"> Cover Saat Ini
                    </label>

                    <div class="flex items-center gap-4">
                        <img src="../uploads/<?= $data['cover']; ?>" class="w-20 h-28 object-cover rounded shadow">

                        <input type="file" name="cover" class="text-sm text-gray-500">
                    </div>

                    <p class="text-xs text-gray-400 mt-1">
                        *Kosongkan jika tidak ingin mengubah cover
                    </p>
                </div>

                <!-- BUTTON -->
                <div class="flex gap-3">
                    <a href="kelola_data_buku.php"
                        class="w-1/3 border-2 border-blue-300 text-blue-600 py-3 rounded-xl hover:bg-gray-50 transition flex items-center justify-center gap-2">
                        Batal
                    </a>
                    <button type="submit" name="update"
                        class="w-2/3 bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 transition shadow-lg flex items-center justify-center gap-2">
                       
                        Update Buku
                    </button>
                </div>

            </form>

        </div>
    </div>
</body>

</html>