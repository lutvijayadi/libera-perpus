<?php

include '../config/koneksi.php';

$query_buku = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY judul_buku DESC");

$keyword = isset($_GET['cari']) ? trim($_GET['cari']) : "";

if (!empty($keyword)) {
    $keyword = mysqli_real_escape_string($koneksi, $keyword);

    $query = "SELECT * FROM buku 
              WHERE judul_buku LIKE '%$keyword%' 
              OR penerbit LIKE '%$keyword%' 
              OR stok LIKE '%$keyword%' 
              ORDER BY judul_buku DESC";
} else {
    $query = "SELECT * FROM buku ORDER BY judul_buku DESC";
}

$query_buku = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&family=Poppins:wght@100..900&display=swap"
        rel="stylesheet">
    <title>libera data buku</title>
</head>

<body class="bg-[#B0FFFA]">
    <!-- sidebar -->
    <?php include 'partials/sidebar.php'; ?>

    <!-- konten utama -->
    <main class="ml-60 p-4 min-h-screen">
        <section>
            <div class="mt-6 bg-gradient-to-r from-blue-600 to-blue-500 p-6 rounded-xl shadow text-white">
                <h2 class="text-2xl font-semibold mb-1">
                    Kelola Data Buku
                </h2>
                <p class="text-sm opacity-90">
                    silakan masukan buku yang akan ditambahkan ke dalam perpustakaan.
                </p>
            </div>
            <div class="mt-10 flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">DAFTAR BUKU</h2>
                <form method="GET" class="flex items-center gap-2">
                    <input type="text" name="cari" placeholder="Cari judul buku, penerbit..."
                        value="<?php echo isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : ''; ?>"
                        class="px-4 py-2 rounded-lg border border-gray-300 text-sm w-64">

                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm">
                        Cari
                    </button>

                    <a href="kelola_data_buku.php"
                        class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 text-sm">
                        Reset
                    </a>
                </form>
                <div class="flex gap-2">
                    <!-- Tombol Tambah -->
                    <a href="../admin/tambah_buku.php"
                        class="flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-all shadow-md hover:shadow-lg text-sm">
                        <i data-feather="plus" class="w-4 h-4"></i>
                        Tambah buku
                    </a>
                </div>
        </section>
        <section class="mt-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php while ($buku = mysqli_fetch_assoc($query_buku)) { ?>
                    <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">

                        <!-- Cover Buku -->
                        <div class="h-48 bg-blue-50 flex items-center justify-center">
                            <?php if (!empty($buku['cover'])) { ?>
                                <img src="../uploads/<?php echo $buku['cover']; ?>" class="h-full object-cover">
                            <?php } else { ?>
                                <span class="text-blue-400 text-sm">No Cover</span>
                            <?php } ?>
                        </div>

                        <!-- Isi Card -->
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-800 truncate">
                                <?php echo $buku['judul_buku']; ?>
                            </h3>

                            <div class="flex justify-between items-center mt-3">
                                <span class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded-full">
                                    <?php echo $buku['penerbit']; ?>
                                </span>

                                <span class="text-xs font-semibold 
                            <?php echo ($buku['stok'] > 0) ? 'text-green-600' : 'text-red-500'; ?>">
                                    Stok: <?php echo $buku['stok']; ?>
                                </span>
                            </div>

                            <!-- Tombol -->
                            <div class="mt-4 flex gap-2">
                                <a href="edit_buku.php?id=<?php echo $buku['id_buku']; ?>"
                                    class="flex-1 text-center text-sm bg-blue-600 text-white py-1.5 rounded-lg hover:bg-blue-700">
                                    Edit
                                </a>

                                <a href="../aksi/aksi_hapus_buku.php?id=<?php echo $buku['id_buku']; ?>"
                                    onclick="return confirm('Hapus buku ini?')"
                                    class="flex-1 text-center text-sm bg-red-500 text-white py-1.5 rounded-lg hover:bg-red-600">
                                    Hapus
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>
    </main>
    <script>
        feather.replace();
    </script>
</body>

</html>