<?php
include '../../config/koneksi.php';

$keyword = isset($_GET['cari']) ? trim($_GET['cari']) : "";

if (!empty($keyword)) {
    $keyword = mysqli_real_escape_string($koneksi, $keyword);
    $kata = explode(" ", $keyword);

    $conditions = [];
    foreach ($kata as $k) {
        $conditions[] = "(nama LIKE '%$k%' OR judul_buku LIKE '%$k%')";
    }

    $where = implode(" AND ", $conditions);

    $query = "SELECT * FROM transaksi 
              WHERE status='selesai' 
              AND ($where)
              ORDER BY id_transaksi DESC";
} else {
    $query = "SELECT * FROM transaksi 
              WHERE status='selesai' 
              ORDER BY id_transaksi DESC";
}

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cetak Transaksi Selesai</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        @media print {
            body {
                background: white !important;
            }
            .shadow-md {
                box-shadow: none !important;
            }
        }
    </style>
</head>

<body onload="window.print()" class="bg-gray-100">

<div class="max-w-5xl mx-auto bg-white p-8 shadow-md rounded-lg">

    <!-- KOP -->
    <div class="text-center border-b-4 border-black pb-4 mb-6">
        <h1 class="text-2xl font-bold">PERPUSTAKAAN SEKOLAH</h1>
        <h2 class="text-lg font-semibold">SMK AL-MADANI GARUT</h2>
        <p class="text-sm text-gray-600">
            Jl. Raya Samarang No.2332, Garut, Jawa Barat 44161
        </p>
    </div>

    <!-- JUDUL -->
    <div class="text-center mb-6">
        <h3 class="text-lg font-semibold underline">
            LAPORAN TRANSAKSI SELESAI
        </h3>
    </div>

    <!-- TABEL -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">No</th>
                    <th class="p-2 border">Nama</th>
                    <th class="p-2 border">Buku</th>
                    <th class="p-2 border">Tanggal Pinjam</th>
                    <th class="p-2 border">Tanggal Kembali</th>
                    <th class="p-2 border">Status</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $no = 1;
                while ($data = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td class="p-2 border text-center"><?= $no++; ?></td>
                    <td class="p-2 border"><?= $data['nama']; ?></td>
                    <td class="p-2 border"><?= $data['judul_buku']; ?></td>
                    <td class="p-2 border text-center"><?= date('d M Y', strtotime($data['tanggal_pinjam'])); ?></td>
                    <td class="p-2 border text-center"><?= date('d M Y', strtotime($data['tanggal_kembali'])); ?></td>
                    <td class="p-2 border text-center">
                        <span class="px-2 py-1 rounded text-xs bg-blue-200 text-blue-800">
                            Selesai
                        </span>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- TTD -->
    <div class="mt-12 flex justify-end">
        <div class="text-center">
            <p>Garut, <?= date("d M Y"); ?></p>
            <p class="mb-16">Kepala Perpustakaan</p>
            <p class="border-t border-black w-40 mx-auto pt-1">
                (............................)
            </p>
        </div>
    </div>

</div>

</body>
</html>