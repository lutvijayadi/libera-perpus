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
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Feather -->
    <script src="https://unpkg.com/feather-icons"></script>

    <title>Edit Buku - Libera</title>
</head>

<body class=" bg-[#B0FFFA]  relative font-poppins min-h-screen flex items-center justify-center">
  
    <!-- CARD -->
    <div class="relative z-10 w-full max-w-xl bg-white/90 backdrop-blur-md rounded-2xl shadow-xl overflow-hidden">

        <!-- HEADER -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-500 p-5 text-white flex items-center gap-3">
            <i data-feather="book-open"></i>
            <h2 class="text-lg font-semibold">Edit Data Buku</h2>
        </div>

        <!-- CONTENT -->
        <div class="p-6">

            <form action="../aksi/aksi_edit_buku.php" method="post" enctype="multipart/form-data" class="space-y-4">

                <input type="hidden" name="id_buku" value="<?= $data['id_buku']; ?>">

                <!-- JUDUL -->
                <div>
                    <label class="text-sm flex items-center gap-2 mb-1">
                        <i data-feather="book"></i> Judul Buku
                    </label>
                    <input type="text" name="judul_buku" value="<?= $data['judul_buku']; ?>" required
                        class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- PENGARANG & PENERBIT -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm flex items-center gap-2 mb-1">
                            <i data-feather="user"></i> Pengarang
                        </label>
                        <input type="text" name="pengarang" value="<?= $data['pengarang']; ?>" required
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                    </div>

                    <div>
                        <label class="text-sm flex items-center gap-2 mb-1">
                            <i data-feather="edit-3"></i> Penerbit
                        </label>
                        <input type="text" name="penerbit" value="<?= $data['penerbit']; ?>" required
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                    </div>
                </div>

                <!-- TAHUN & STOK -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm flex items-center gap-2 mb-1">
                            <i data-feather="calendar"></i> Tahun
                        </label>
                        <input type="number" name="tahun_terbit" value="<?= $data['tahun_terbit']; ?>" required
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                    </div>

                    <div>
                        <label class="text-sm flex items-center gap-2 mb-1">
                            <i data-feather="layers"></i> Stok
                        </label>
                        <input type="number" name="stok" value="<?= $data['stok']; ?>" required
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                    </div>
                </div>

                <!-- COVER -->
                <div>
                    <label class="text-sm flex items-center gap-2 mb-2">
                        <i data-feather="image"></i> Cover Saat Ini
                    </label>

                    <div class="flex items-center gap-4">
                        <img src="../uploads/<?= $data['cover']; ?>" 
                             class="w-20 h-28 object-cover rounded shadow">

                        <input type="file" name="cover" 
                            class="text-sm text-gray-500">
                    </div>

                    <p class="text-xs text-gray-400 mt-1">
                        *Kosongkan jika tidak ingin mengubah cover
                    </p>
                </div>

                <!-- BUTTON -->
                <button type="submit" name="update"
                    class="w-full bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 transition shadow-lg flex items-center justify-center gap-2">
                    <i data-feather="save"></i> Update Buku
                </button>

            </form>

        </div>
    </div>

    <script>
        feather.replace();
    </script>

</body>
</html>