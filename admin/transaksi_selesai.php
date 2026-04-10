<?php
include '../config/koneksi.php';

$result = mysqli_query($koneksi, "
    SELECT * FROM transaksi 
    WHERE status='selesai' 
    ORDER BY id_transaksi DESC
");

if (!$result) {
    die("Query error: " . mysqli_error($koneksi));
}

$keyword = isset($_GET['cari']) ? trim($_GET['cari']) : "";

if (!empty($keyword)) {
    $keyword = mysqli_real_escape_string($koneksi, $keyword);

    $query = "
        SELECT * FROM transaksi 
        WHERE status='selesai' AND (
            nama LIKE '%$keyword%' OR
            judul_buku LIKE '%$keyword%' OR
            tanggal_pinjam LIKE '%$keyword%' OR
            tanggal_kembali LIKE '%$keyword%'
        )
        ORDER BY id_transaksi DESC
    ";
} else {
    $query = "
        SELECT * FROM transaksi 
        WHERE status='selesai' 
        ORDER BY id_transaksi DESC
    ";
}

$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query error: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Transaksi Selesai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body class="bg-[#B0FFFA] p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <i data-feather="archive"></i>
            Transaksi Selesai
        </h2>
    </div>

    <!-- SEARCH + CETAK -->
    <div class="flex justify-between items-center mb-4 flex-wrap gap-3">

        <form method="GET" class="flex items-center gap-2">
            <input type="text" name="cari" placeholder="Cari nama / buku..."
                value="<?= isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : ''; ?>"
                class="px-4 py-2 rounded-lg border border-gray-300 text-sm w-64">

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm">
                Cari
            </button>

            <!-- FIX RESET -->
            <a href="transaksi_selesai.php"
                class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 text-sm">
                Reset
            </a>
        </form>
        <a href="../resources/cetak/cetak_selesai_transaksi.php?cari=<?= isset($_GET['cari']) ? urlencode($_GET['cari']) : '' ?>"
            target="_blank"
            class="flex items-center gap-2 px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 text-sm">
           <img src="../resources/img/cetak.png" class="w-5 h-5 opacity-80">
            Cetak
        </a>

    </div>

    <!-- TABLE -->
    <section>
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden">

            <!-- HEADER TABLE -->
            <div class="flex justify-between items-center px-6 py-4 bg-blue-600 text-white">
                <h2 class="text-lg font-semibold">Data Transaksi Selesai</h2>
                <span class="text-sm">
                    Total: <?= mysqli_num_rows($result); ?>
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-gray-700">

                    <thead class="bg-blue-500 text-white text-xs uppercase">
                        <tr>
                            <th class="px-6 py-3 text-center">ID</th>
                            <th class="px-6 py-3">Nama</th>
                            <th class="px-6 py-3">Buku</th>
                            <th class="px-6 py-3">Tanggal</th>
                            <th class="px-6 py-3 text-center">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                            <tr class="hover:bg-blue-50 transition">

                                <td class="px-6 py-4 text-center text-gray-500 font-semibold">
                                    <?= $row['id_transaksi']; ?>
                                </td>

                                <td class="px-6 py-4 font-semibold text-gray-900">
                                    <?= $row['nama']; ?>
                                </td>

                                <td class="px-6 py-4 text-gray-700">
                                    <?= $row['judul_buku']; ?>
                                </td>

                                <td class="px-6 py-4 text-xs">
                                    <div class="flex flex-col gap-1">
                                        <span class="flex items-center gap-1 text-blue-500">
                                            
                                            <?= date('d M Y', strtotime($row['tanggal_pinjam'])); ?>
                                        </span>
                                        <span class="flex items-center gap-1 text-red-400">
                                            
                                            <?= date('d M Y', strtotime($row['tanggal_kembali'])); ?>
                                        </span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="flex items-center justify-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-600">
                                        <img src="../resources/img/selesai.png" class="w-4 h-4">
                                        Selesai
                                    </span>
                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>
                </table>
            </div>

    </section>
    <section class="mt-8 ">
        <d class="justify-end">
            <a href="transaksi.php"
                class="mt-8 w-60 p-4 flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-x ml-auto transition-all shadow-md hover:shadow-lg">
                <img src="../resources/img/riwayat.png" class="w-5 h-5 opacity-80">
                Kembali ke Transaksi
            </a>
            </div>
    </section>
    <script>
        feather.replace();
    </script>
</body>

</html>