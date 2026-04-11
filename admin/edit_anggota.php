<?php
include '../config/koneksi.php';

// CEK PARAMETER
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Data tidak ditemukan!";
    exit;
}

$id = $_GET['id'];

// QUERY BERDASARKAN ID
$query = mysqli_query($koneksi, "SELECT * FROM users WHERE id_users = '$id'");
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

    <link rel="stylesheet" href="../public/src/output.css">
    <title>Edit Anggota</title>
</head>

<body class="bg-[#B0FFFA] relative font-poppins min-h-screen flex items-center justify-center">

    <!-- CARD -->
    <div class="relative z-10 w-full max-w-md bg-white/90 backdrop-blur-md rounded-2xl shadow-xl overflow-hidden">

        <!-- HEADER -->
        <div class="bg-linear-to-r from-blue-600 to-blue-500 p-5 text-white flex items-center gap-3">
            <img src="../resources/img/anggota.png" class="w-5 h-5">
            <h2 class="text-lg font-semibold">Edit Anggota</h2>
        </div>

        <!-- CONTENT -->
        <div class="p-6">

            <form action="../aksi/aksi_edit_anggota.php" method="post" class="space-y-4">

                <!-- HIDDEN ID -->
                <input type="hidden" name="id_users" value="<?= $data['id_users']; ?>">

                <!-- NAMA -->
                <div>
                    <label class="text-sm flex items-center gap-2 mb-1">
                        <img src="../resources/img/profil.png" class="w-4 h-4"> Nama
                    </label>
                    <input type="text" name="nama" value="<?= $data['nama']; ?>" required
                        class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- KELAS -->
                <div>
                    <label class="text-sm flex items-center gap-2 mb-1">
                        <img src="../resources/img/kelas.png" class="w-4 h-4"> Kelas
                    </label>
                    <input type="text" name="kelas" value="<?= $data['kelas']; ?>" required
                        class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- STATUS -->
                <div>
                    <label class="text-sm flex items-center gap-2 mb-1">
                        <img src="../resources/img/status.png" class="w-4 h-4"> Status
                    </label>
                    <select name="status" class="w-full p-2 border rounded-lg">
                        <option value="aktif" <?= $data['status'] == 'aktif' ? 'selected' : ''; ?>>Aktif</option>
                        <option value="non-aktif" <?= $data['status'] == 'non-aktif' ? 'selected' : ''; ?>>Non Aktif
                        </option>
                    </select>
                </div>

                <div class="flex gap-3 pt-2">
                    <a href="kelola_anggota.php"
                        class="flex-1 border-2 border-blue-300 text-blue-600 py-3 rounded-xl hover:bg-gray-50 transition flex items-center justify-center gap-2 font-medium">
                        Batal
                    </a>

                    <button type="submit" name="edit"
                        class="flex-2 bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 transition shadow-lg flex items-center justify-center gap-2 font-semibold group">
                        <span>Simpan Perubahan</span>
                    </button>
                </div>

            </form>

        </div>
    </div>

</body>

</html>