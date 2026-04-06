<?php
include '../config/koneksi.php';

// Query untuk mengambil data transaksi
// Jika tabel transaksi belum memiliki id_anggota, kita tetap bisa menampilkan data
$query = "SELECT * FROM transaksi ORDER BY id_transaksi DESC";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($koneksi));
}

$keyword = isset($_GET['cari']) ? trim($_GET['cari']) : "";

if (!empty($keyword)) {
    $keyword = mysqli_real_escape_string($koneksi, $keyword);

    $query = "SELECT * FROM transaksi 
              WHERE 
                nama LIKE '%$keyword%' OR
                judul_buku LIKE '%$keyword%' OR
                status LIKE '%$keyword%' OR
                tanggal_pinjam LIKE '%$keyword%' OR
                tanggal_kembali LIKE '%$keyword%'
              ORDER BY id_transaksi DESC";
} else {
    $query = "SELECT * FROM transaksi ORDER BY id_transaksi DESC";
}

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100..900&display=swap" rel="stylesheet">
    <title>Libera Transaksi</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-[#B0FFFA]">
    <?php include 'partials/sidebar.php'; ?>

    <main class="ml-60 p-4 min-h-screen">
        <section>
            <div class="mt-6 bg-gradient-to-r from-blue-600 to-blue-500 p-6 rounded-xl shadow text-white">
                <h2 class="text-2xl font-semibold mb-1">
                    Kelola Transaksi
                </h2>
                <p class="text-sm opacity-90">
                    silakan kelola transaksi peminjaman dan pengembalian buku anggota perpustakaan.
                </p>
            </div>
            <div class="mt-8 flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">DAFTAR TRANSAKSI</h2>
                <form method="GET" class="mb-4 flex items-center gap-2">
                    <input type="text" name="cari" placeholder="Cari nama buku..."
                        value="<?php echo isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : ''; ?>"
                        class="px-4 py-2 rounded-lg border border-gray-300 text-sm w-64">

                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm">
                        Cari
                    </button>

                    <a href="transaksi.php"
                        class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 text-sm">
                        Reset
                    </a>
                </form>
                <div class="flex gap-2">
                    <a href="../resources/cetak/cetak_transaksi.php?cari=<?php echo isset($_GET['cari']) ? urlencode($_GET['cari']) : ''; ?>"
                        target="_blank"
                        class="flex items-center gap-2 px-5 py-2.5 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition-all shadow-md hover:shadow-lg text-sm">
                        <i data-feather="printer" class="w-4 h-4"></i>
                        Cetak
                    </a>
                    <!-- Tombol Tambah -->
                    <a href="../admin/tambah_anggota.php"
                        class="flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-all shadow-md hover:shadow-lg text-sm">
                        <i data-feather="plus" class="w-4 h-4"></i>
                        Tambah transaksi
                    </a>
                </div>
            </div>

            <div class="mt-4 relative overflow-hidden bg-blue-300 shadow-md rounded-2xl border border-blue-200">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs uppercase bg-blue-600 text-white border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 font-bold text-center">ID</th>
                            <th class="px-6 py-4 font-bold">Nama Anggota</th>
                            <th class="px-6 py-4 font-bold">Judul Buku</th>
                            <th class="px-6 py-4 font-bold">Tgl Pinjam</th>
                            <th class="px-6 py-4 font-bold">Tgl Kembali</th>
                            <th class="px-6 py-4 font-bold text-center">Status</th>
                            <th class="px-6 py-4 font-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Logika warna badge status
                            $status_class = "";
                            if ($row['status'] == 'dipinjam') {
                                $status_class = "bg-orange-100 text-orange-600";
                            } elseif ($row['status'] == 'kembali') {
                                $status_class = "bg-green-100 text-green-600";
                            } else {
                                $status_class = "bg-gray-100 text-gray-600";
                            }
                            ?>
                            <tr class="hover:bg-blue-50/50 transition-colors">
                                <td class="px-6 py-4 text-center font-medium text-gray-400">
                                    <?php echo $row['id_transaksi']; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900">
                                        <?php echo isset($row['nama']) ? $row['nama'] : '-'; ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-gray-700 italic">"<?php echo $row['judul_buku']; ?>"</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="flex items-center gap-1">
                                        <i data-feather="calendar" class="w-3 h-3 text-blue-400"></i>
                                        <?php echo date('d M Y', strtotime($row['tanggal_pinjam'])); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="flex items-center gap-1">
                                        <i data-feather="calendar" class="w-3 h-3 text-red-300"></i>
                                        <?php echo date('d M Y', strtotime($row['tanggal_kembali'])); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-bold uppercase <?php echo $status_class; ?>">
                                        <?php echo $row['status']; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="edit_transaksi.php?id_transaksi=<?php echo $row['id_transaksi']; ?>
                                            class=" p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition-all"
                                            title="Edit Transaksi">
                                            <i data-feather="edit-2" class="w-4 h-4"></i>
                                        </a>
                                        <a href="../aksi/aksi_hapus_transaksi.php?id_transaksi=<?php echo $row['id_transaksi']; ?>
                                            onclick=" return confirm('Yakin ingin menghapus data transaksi ini?')"
                                            class="p-2 text-red-500 hover        :bg-red-50 rounded-lg transition-all"
                                            title="Hapus">
                                            <i data-feather="trash-2" class="w-4 h-4"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                        mysqli_close($koneksi);
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script>
        feather.replace();
    </script>
</body>

</html>