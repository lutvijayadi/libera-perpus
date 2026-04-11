<?php
include '../config/koneksi.php';


$query = "SELECT * FROM transaksi ORDER BY id_transaksi DESC";
$result = mysqli_query($koneksi, $query);

$query = "SELECT * FROM users ORDER BY id_users DESC";
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
    <link rel="stylesheet" href="../public/src/output.css">

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
            <div class="mt-6 bg-linear-to-r from-[#2563eb] to-[#3b82f6] p-6 rounded-xl shadow text-white">
                <h2 class="text-2xl font-semibold mb-1">
                    Kelola Transaksi
                </h2>
                <p class="text-sm opacity-90">
                    silakan kelola transaksi peminjaman dan pengembalian buku anggota perpustakaan.
                </p>
            </div>
            <div class="mt-8 flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
                <h2 class="text-xl font-bold text-gray-800 tracking-tight uppercase">Daftar Transaksi</h2>

                <div class="flex flex-wrap items-center gap-3">
                    <form method="GET"
                        class="flex items-center gap-2 bg-white p-1.5 pl-4 rounded-xl shadow-sm border border-gray-100">
                        <img src="../public/src/icons/search.png" class="w-4 h-4 opacity-40">

                        <input type="text" name="cari" placeholder="Cari judul buku..."
                            value="<?php echo isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : ''; ?>"
                            class="text-sm outline-none w-56 bg-transparent text-gray-700">

                        <button type="submit"
                            class="px-4 py-1.5 bg-blue-600 text-white rounded-lg text-xs font-semibold hover:bg-blue-700 transition-all shadow-md shadow-blue-100">
                            Cari
                        </button>

                        <?php if (isset($_GET['cari']) && $_GET['cari'] != ''): ?>
                            <a href="transaksi.php"
                                class="px-3 py-1.5 bg-gray-100 text-gray-500 rounded-lg text-xs font-semibold hover:bg-gray-200 transition-colors mr-1">
                                Reset
                            </a>
                        <?php endif; ?>
                    </form>

                    <div class="flex gap-2">
                        <a href="../resources/cetak/cetak_transaksi.php?cari=<?php echo isset($_GET['cari']) ? urlencode($_GET['cari']) : ''; ?>"
                            target="_blank"
                            class="flex items-center gap-2 px-5 py-2.5 bg-emerald-600 text-white font-bold rounded-xl hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-100 text-sm">
                            <img src="../resources/img/cetak.png" class="w-4 h-4 brightness-0 invert">
                            <span>Cetak Laporan</span>
                        </a>
                    </div>
                </div>
            </div>

            <section>
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
                                <th class="px-6 py-4 font-bold text-center">Selesai</th>
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
                                    <td class="px-6 py-4 text-center">
                                        <?php if ($row['status'] != 'selesai') { ?>
                                            <a href="../aksi/aksi_selesai.php?id=<?php echo $row['id_transaksi']; ?>"
                                                onclick="return confirm('Tandai sebagai selesai?')"
                                                class="px-3 py-1 bg-blue-500 text-white rounded-lg text-xs hover:bg-blue-600">
                                                Selesai
                                            </a>
                                        <?php } else { ?>
                                            <span class="text-blue-600 font-semibold text-xs">Selesai</span>
                                        <?php } ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-1.5">

                                            <a href="edit_transaksi.php?id_transaksi=<?= $row['id_transaksi'] ?>"
                                                class="p-2 text-blue-600 hover:bg-blue-100/70 rounded-lg transition-all"
                                                title="Edit Transaksi">
                                                <img src="../resources/img/edit.png" class="w-4 h-4 opacity-70">
                                            </a>

                                            <a href="../aksi/aksi_hapus_transaksi.php?id_transaksi=<?= $row['id_transaksi'] ?>"
                                                onclick="return confirm('Yakin ingin menghapus data transaksi ini?')"
                                                class="p-2 text-rose-500 hover:bg-rose-100/70 rounded-lg transition-all"
                                                title="Hapus">
                                                <img src="../resources/img/hapus2.png" class="w-4 h-4 opacity-70">
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
                <div class="justify-end">
                    <a href="transaksi_selesai.php"
                        class="mt-8 w-60 p-4 flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-x ml-auto transition-all shadow-md hover:shadow-lg">
                        <img src="../resources/img/riwayat.png" class="w-5 h-5 opacity-80">
                        Riwayat Transaksi
                    </a>
                    </div>
            </section>
    </main>
</body>

</html>