<?php
include '../config/koneksi.php';

// CEK PARAMETER
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Data tidak ditemukan!";
    exit;
}

$id = $_GET['id'];

// QUERY BERDASARKAN ID (BENAR)
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

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Feather -->
    <script src="https://unpkg.com/feather-icons"></script>

    <title>Edit Anggota</title>
</head>

<body class="bg-[#B0FFFA] relative font-poppins min-h-screen flex items-center justify-center">

    <!-- CARD -->
    <div class="relative z-10 w-full max-w-md bg-white/90 backdrop-blur-md rounded-2xl shadow-xl overflow-hidden">

        <!-- HEADER -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-500 p-5 text-white flex items-center gap-3">
            <i data-feather="edit"></i>
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
                        <i data-feather="user"></i> Nama
                    </label>
                    <input type="text" name="nama" value="<?= $data['nama']; ?>" required
                        class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- KELAS -->
                <div>
                    <label class="text-sm flex items-center gap-2 mb-1">
                        <i data-feather="book"></i> Kelas
                    </label>
                    <input type="text" name="kelas" value="<?= $data['kelas']; ?>" required
                        class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- STATUS -->
                <div>
                    <label class="text-sm flex items-center gap-2 mb-1">
                        <i data-feather="check-circle"></i> Status
                    </label>
                    <select name="status" class="w-full p-2 border rounded-lg">
                        <option value="aktif" <?= $data['status']=='aktif'?'selected':''; ?>>Aktif</option>
                        <option value="non-aktif" <?= $data['status']=='non-aktif'?'selected':''; ?>>Non Aktif</option>
                    </select>
                </div>

                <!-- BUTTON -->
                <button type="submit" name="edit"
                    class="w-full bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 transition flex items-center justify-center gap-2">
                    <i data-feather="save"></i> Simpan Perubahan
                </button>

            </form>

        </div>
    </div>

    <script>
        feather.replace();
    </script>

</body>
</html>