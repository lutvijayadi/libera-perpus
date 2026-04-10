<?php
session_start();
include '../config/koneksi.php';

// cek login
if (!isset($_SESSION['id_users'])) {
    header("Location: ../auth/login.php");
    exit;
}

$id_users = $_SESSION['id_users'];

// ambil transaksi user
$query = mysqli_query($koneksi, "
    SELECT * FROM transaksi 
    WHERE id_users='$id_users'
    ORDER BY id_transaksi DESC
");

if (!$query) {
    die("Query error: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Status Peminjaman</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body class="bg-[#B0FFFA] p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <i data-feather="book"></i>
            Status Peminjaman Saya
        </h2>
    </div>

    <!-- TABLE -->
    <section>
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden">

            <!-- HEADER TABLE -->
            <div class="flex justify-between items-center px-6 py-4 bg-blue-600 text-white">
                <h2 class="text-lg font-semibold">Data Peminjaman</h2>
                <span class="text-sm">
                    Total: <?= mysqli_num_rows($query); ?>
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-gray-700">

                    <thead class="bg-blue-500 text-white text-xs uppercase">
                        <tr>
                            <th class="px-6 py-3 text-center">ID</th>
                            <th class="px-6 py-3">Judul Buku</th>
                            <th class="px-6 py-3">Tanggal</th>
                            <th class="px-6 py-3 text-center">Status</th>
                            <th class="px-6 py-3">Keterangan</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        <?php while ($row = mysqli_fetch_assoc($query)) {

                            // STATUS
                            if ($row['status'] == 'menunggu konfirmasi') {
                                $badge = "bg-yellow-100 text-yellow-700";
                                $ket = "Menunggu persetujuan admin";
                            } elseif ($row['status'] == 'disetujui') {
                                $badge = "bg-blue-100 text-blue-700";
                                $ket = "Buku siap diambil";
                            } elseif ($row['status'] == 'ditolak') {
                                $badge = "bg-red-100 text-red-700";
                                $ket = "Peminjaman ditolak";
                            } elseif ($row['status'] == 'selesai') {
                                $badge = "bg-green-100 text-green-700";
                                $ket = "Buku sudah dikembalikan";
                            } else {
                                $badge = "bg-gray-100 text-gray-600";
                                $ket = "-";
                            }
                        ?>

                            <tr class="hover:bg-blue-50 transition">

                                <td class="px-6 py-4 text-center text-gray-500 font-semibold">
                                    <?= $row['id_transaksi']; ?>
                                </td>

                                <td class="px-6 py-4 font-semibold text-gray-900">
                                    <?= $row['judul_buku']; ?>
                                </td>

                                <td class="px-6 py-4 text-xs">
                                    <div class="flex flex-col gap-1">
                                        <span class="text-blue-500">
                                            <?= date('d M Y', strtotime($row['tanggal_pinjam'])); ?>
                                        </span>
                                        <span class="text-red-400">
                                            <?= date('d M Y', strtotime($row['tanggal_kembali'])); ?>
                                        </span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold <?= $badge ?>">
                                        <?= $row['status']; ?>
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-gray-600 text-sm">
                                    <?= $ket; ?>
                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>
                </table>
            </div>

        </div>
    </section>

    <script>
        feather.replace();
    </script>

</body>

</html>