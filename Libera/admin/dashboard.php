<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}
// Query untuk menghitung total semua buku
$query_total = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM buku");
$data_total = mysqli_fetch_assoc($query_total);


$username = $_SESSION['username'];
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM users WHERE username='$username'"
);
$user = mysqli_fetch_assoc($query);


$query_aktivitas = mysqli_query($koneksi, "
    SELECT p.*, u.nama, p.judul_buku
    FROM transaksi p
    JOIN users u ON p.nama = u.username
    JOIN buku b ON p.judul_buku = b.judul_buku
    ORDER BY p.tanggal_pinjam DESC
    LIMIT 5
");

$query_pengunjung = mysqli_query($koneksi, "
    SELECT 
        MONTH(IFNULL(created_at, NOW())) as bulan, 
        COUNT(*) as total
    FROM users
    GROUP BY MONTH(IFNULL(created_at, NOW()))
    ORDER BY bulan
");

$query_peminjaman = mysqli_query($koneksi, "
    SELECT 
        MONTH(tanggal_pinjam) as bulan, 
        COUNT(*) as total
    FROM transaksi
    GROUP BY MONTH(tanggal_pinjam)
    ORDER BY bulan
");

if (!$query_peminjaman) {
    die("Query error: " . mysqli_error($koneksi));
}

$query_anggota = mysqli_query($koneksi, "
    SELECT COUNT(*) as total
    FROM users
    WHERE level = 'user'
");

$data_anggota = mysqli_fetch_assoc($query_anggota);

$query_pinjam = mysqli_query($koneksi, "
    SELECT COUNT(*) as total 
    FROM transaksi 
    WHERE status = 'dipinjam'
");

$data_pinjam = mysqli_fetch_assoc($query_pinjam);

$query_pengunjung_bulan = mysqli_query($koneksi, "
    SELECT COUNT(*) as total 
    FROM users 
    WHERE MONTH(created_at) = MONTH(CURRENT_DATE())
    AND YEAR(created_at) = YEAR(CURRENT_DATE())
");

$data_pengunjung = mysqli_fetch_assoc($query_pengunjung_bulan);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&family=Poppins:wght@100..900&display=swap"
        rel="stylesheet">
    <title>libera admin</title>
</head>


<body class="bg-[#B0FFFA] font-poppins">

    <?php include 'partials/sidebar.php'; ?>

    <!-- KONTEN UTAMA -->
    <main class="ml-60 p-4 min-h-screen">
        <section>
            <div class="mt-6 bg-gradient-to-r from-blue-600 to-blue-500 p-6 rounded-xl shadow text-white">
                <h2 class="text-2xl font-semibold mb-1">
                    Halo, <?php echo $user['nama']; ?>
                </h2>
                <p class="text-sm opacity-90">
                    Selamat datang di dashboard admin Libera. Kelola data perpustakaan dengan mudah.
                </p>
            </div>
        </section>

        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
            <!-- Anggota -->
            <div class="bg-white p-5 rounded-xl shadow hover:shadow-lg transition">
                <p class="text-sm text-gray-500">Total Anggota</p>

                <h3 class="text-3xl font-bold text-blue-600 mt-2">
                    <?php echo $data_anggota['total']; ?>
                </h3>
                <p class="text-xs text-gray-400 mt-1">anggota terdaftar</p>
            </div>

            <!-- Buku -->
            <div class="bg-white p-5 rounded-xl shadow hover:shadow-lg transition">
                <p class="text-sm text-gray-500">Total Buku</p>
                <h3 class="text-3xl font-bold text-blue-600 mt-2">
                    <?php echo $data_total['total']; ?>
                </h3>
                <p class="text-xs text-gray-400 mt-1">buku tersedia</p>
            </div>

            <!-- Dipinjam -->
            <div class="bg-white p-5 rounded-xl shadow hover:shadow-lg transition">
                <p class="text-sm text-gray-500">Sedang Dipinjam</p>
                <h3 class="text-3xl font-bold text-blue-600 mt-2">
                    <?php echo number_format($data_pinjam['total']); ?>
                </h3>
                <p class="text-xs text-gray-400 mt-1">buku dipinjam</p>
            </div>
            <!-- Pengunjung -->
            <div class="bg-white p-5 rounded-xl shadow hover:shadow-lg transition">
                <p class="text-sm text-gray-500">Total Pengunjung</p>

                <h3 class="text-3xl font-bold text-blue-600 mt-2">
                    <?php echo number_format($data_pengunjung['total']); ?>
                </h3>
                <p class="text-xs text-gray-400 mt-1">bulan ini</p>
            </div>
        </section>
        <section>
            <div>
                <h2 class="text-lg font-semibold text-gray-700 mb-4 mt-6">
                    Aktivitas Terbaru
                </h2>
                <a href="../admin/notifications.php"
                    class="flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-all shadow-md hover:shadow-lg text-sm">
                    <i data-feather="message-square" class="w-4 h-4"></i>
                    lihat notif
                </a>
            </div>
        </section>

        <section class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">

            <!-- Grafik Pengunjung -->
            <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">
                    Grafik Pengunjung Bulanan
                </h2>
                <div id="chartPengunjung" class="h-64"></div>
            </div>

            <!-- Grafik Peminjaman -->
            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">
                    Grafik Peminjaman Bulanan
                </h2>
                <div id="chartPeminjaman" class="h-64"></div>
            </div>
            </div>

        </section>

    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            // Grafik Pengunjung
            var chart1 = new ApexCharts(document.querySelector("#chartPengunjung"), {
                chart: {
                    type: 'line',
                    height: 250
                },
                series: [{
                    name: 'Pengunjung',
                    data: <?php echo json_encode($total); ?>
                }],
                xaxis: {
                    categories: <?php echo json_encode($bulan); ?>
                },
                stroke: {
                    curve: 'smooth'
                }
            });
            chart1.render();


            // Grafik Peminjaman
            var chart2 = new ApexCharts(document.querySelector("#chartPeminjaman"), {
                chart: {
                    type: 'bar',
                    height: 250
                },
                series: [{
                    name: 'Peminjaman',
                    data: <?php echo json_encode($total_pinjam); ?>
                }],
                xaxis: {
                    categories: <?php echo json_encode($bulan_pinjam); ?>
                }
            });
            chart2.render();

        });
    </script>
    <!-- akhir conten -->

    <script>
        feather.replace();
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>

</html>