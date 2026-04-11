<?php
include '../config/koneksi.php';

$keyword = isset($_GET['cari']) ? trim($_GET['cari']) : "";
$kategori = isset($_GET['kategori']) ? trim($_GET['kategori']) : "";

$conditions = [];

if (!empty($keyword)) {
    $keyword = mysqli_real_escape_string($koneksi, $keyword);
    $conditions[] = "(judul_buku LIKE '%$keyword%' 
                    OR penerbit LIKE '%$keyword%')";
}

if (!empty($kategori)) {
    $kategori = mysqli_real_escape_string($koneksi, $kategori);
    $conditions[] = "kategori = '$kategori'";
}

$where = "";
if (!empty($conditions)) {
    $where = "WHERE " . implode(" AND ", $conditions);
}

$query = "SELECT * FROM buku $where ORDER BY judul_buku DESC";
$query_buku = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/src/output.css">
    <title>libera data buku</title>
</head>

<body class="bg-[#B0FFFA]">
    <!-- sidebar -->
    <?php include 'partials/sidebar.php'; ?>

    <!-- konten utama -->
    <main class="ml-60 p-4 min-h-screen">
        <section>
            <div class="mt-6 bg-linear-to-r from-[#2563eb] to-[#3b82f6] p-6 rounded-xl shadow text-white">
                <h2 class="text-2xl font-semibold mb-1 flex items-center gap-2">
                    <i data-feather="book-open"></i>
                    Kelola Data Buku
                </h2>
                <p class="text-sm opacity-90">
                    Kelola dan tambahkan koleksi buku perpustakaan.
                </p>
            </div>

            <div class="mt-10 flex flex-wrap justify-between items-center gap-4">

                <h2 class="text-xl font-bold text-gray-800">DAFTAR BUKU</h2>

                <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
                    <form method="GET"
                        class="flex items-center gap-3 bg-white p-2 pl-4 rounded-2xl shadow-sm border border-gray-100 w-full md:w-auto">

                        <div class="flex items-center gap-2 border-r border-gray-100 pr-3">
                            <img src="../public/src/icons/search.png" class="w-4 h-4 opacity-40">
                            <input type="text" name="cari" placeholder="Cari buku..."
                                value="<?= isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : ''; ?>"
                                class="text-sm outline-none bg-transparent w-40 text-gray-700">
                        </div>

                        <div class="flex items-center gap-2">
                            <select name="kategori"
                                class="text-xs bg-transparent outline-none cursor-pointer text-gray-500 font-medium">
                                <option value="">Semua Kategori</option>
                                <option value="pelajaran" <?= (isset($kategori) && $kategori == 'pelajaran') ? 'selected' : '' ?>>Pelajaran</option>
                                <option value="novel" <?= (isset($kategori) && $kategori == 'novel') ? 'selected' : '' ?>>
                                    Novel</option>
                                <option value="cerita" <?= (isset($kategori) && $kategori == 'cerita') ? 'selected' : '' ?>>Cerita</option>
                                <option value="filsafat" <?= (isset($kategori) && $kategori == 'filsafat') ? 'selected' : '' ?>>Filsafat</option>
                            </select>
                        </div>

                        <div class="flex gap-1 ml-2">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-xl text-xs font-semibold hover:bg-blue-700 transition-all shadow-md shadow-blue-100 flex items-center gap-1">
                                Cari
                            </button>

                            <?php if (!empty($_GET['cari']) || !empty($_GET['kategori'])): ?>
                                <a href="kelola_data_buku.php"
                                    class="px-4 py-2 bg-gray-100 text-gray-500 rounded-xl text-xs font-semibold hover:bg-gray-200 transition-colors">
                                    Reset
                                </a>
                            <?php endif; ?>
                        </div>
                    </form>

                    <a href="../admin/tambah_buku.php"
                        class="flex items-center gap-2 px-6 py-2.5 bg-blue-600 text-white font-bold rounded-2xl hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all hover:-translate-y-0.5 text-sm">
                        <img src="../resources/img/tambah.png" class="w-4 h-4 brightness-0 invert">
                        <span>Tambah Buku</span>
                    </a>
                </div>

            </div>
        </section>

        <!-- GRID BUKU -->
        <section class="mt-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                <?php while ($buku = mysqli_fetch_assoc($query_buku)) { ?>

                    <div class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden">

                        <!-- COVER -->
                        <div class="h-48 bg-blue-50 flex items-center justify-center">
                            <?php if (!empty($buku['cover'])) { ?>
                                <img src="../uploads/<?php echo $buku['cover']; ?>" class="h-full w-full object-cover">
                            <?php } else { ?>
                                <div class="text-center text-blue-400 text-sm">
                                    <i data-feather="image"></i>
                                    <p>No Cover</p>
                                </div>
                            <?php } ?>
                        </div>

                        <!-- CONTENT -->
                        <div class="p-4 space-y-3">

                            <!-- JUDUL -->
                            <h3 class="font-semibold text-gray-800 truncate">
                                <?php echo $buku['judul_buku']; ?>
                            </h3>

                            <!-- PENERBIT + STOK -->
                            <div class="flex justify-between items-center text-xs">

                                <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded-full">
                                    <?php echo $buku['penerbit']; ?>
                                </span>

                                <span class="font-semibold 
                            <?php echo ($buku['stok'] > 0) ? 'text-green-600' : 'text-red-500'; ?>">
                                    Stok: <?php echo $buku['stok']; ?>
                                </span>

                            </div>

                            <!-- KATEGORI -->
                            <div>
                                <span class="bg-purple-100 text-purple-600 px-2 py-1 rounded-full text-xs">
                                    <?php echo $buku['kategori']; ?>
                                </span>
                            </div>

                            <!-- BUTTON -->
                            <div class="flex gap-2 pt-2">
                                <a href="edit_buku.php?id=<?php echo $buku['id_buku']; ?>"
                                    class="flex-1 text-center text-sm bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 flex items-center justify-center gap-1">
                                    Edit
                                </a>

                                <a href="../aksi/aksi_hapus_buku.php?id=<?php echo $buku['id_buku']; ?>"
                                    onclick="return confirm('Hapus buku ini?')"
                                    class="flex-1 text-center text-sm bg-red-500 text-white py-2 rounded-lg hover:bg-red-600 flex items-center justify-center gap-1">
                                    Hapus
                                </a>
                            </div>

                        </div>
                    </div>

                <?php } ?>

            </div>
        </section>
    </main>
</body>

</html>