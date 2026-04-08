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
if (!$query_pengunjung) {
    die("Query pengunjung error: " . mysqli_error($koneksi));
}
$bulan = [];
$total = [];

while ($row = mysqli_fetch_assoc($query_pengunjung)) {
    $bulan[] = $row['bulan'];
    $total[] = $row['total'];
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
                    Halo, <?php echo isset($user['nama']) ? $user['nama'] : 'User'; ?>
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
                    lihat notifikasi
                </a>
            </div>
        </section>

        <section class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">

            <!-- Grafik Pengunjung -->
            <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">
                    Grafik Pengunjung Bulanan
                </h2>


                <div class="flex items-center mb-3">
                    <div class="flex items-center space-x-1">
                        <svg class="w-5 h-5 text-fg-yellow" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                        <svg class="w-5 h-5 text-fg-yellow" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                        <svg class="w-5 h-5 text-fg-yellow" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                        <svg class="w-5 h-5 text-fg-yellow" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                        <svg class="w-5 h-5 text-fg-disabled" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                    </div>
                    <p class="ms-2 text-sm font-medium text-body">4.95 out of 5</p>
                </div>
                <p class="text-sm font-medium text-body">1,745 global ratings</p>
                <div class="flex items-center mt-4">
                    <a href="#" class="text-sm font-medium text-fg-brand hover:underline w-14">5 star</a>
                    <div class="w-2/4 h-4 mx-4 bg-neutral-quaternary rounded-base">
                        <div class="h-4 bg-warning rounded-base" style="width: 70%"></div>
                    </div>
                    <span class="text-sm font-medium text-body">70%</span>
                </div>
                <div class="flex items-center mt-4">
                    <a href="#" class="text-sm font-medium text-fg-brand hover:underline w-14">4 star</a>
                    <div class="w-2/4 h-4 mx-4 bg-neutral-quaternary rounded-base">
                        <div class="h-4 bg-warning rounded-base" style="width: 17%"></div>
                    </div>
                    <span class="text-sm font-medium text-body">17%</span>
                </div>
                <div class="flex items-center mt-4">
                    <a href="#" class="text-sm font-medium text-fg-brand hover:underline w-14">3 star</a>
                    <div class="w-2/4 h-4 mx-4 bg-neutral-quaternary rounded-base">
                        <div class="h-4 bg-warning rounded-base" style="width: 8%"></div>
                    </div>
                    <span class="text-sm font-medium text-body">8%</span>
                </div>
                <div class="flex items-center mt-4">
                    <a href="#" class="text-sm font-medium text-fg-brand hover:underline w-14">2 star</a>
                    <div class="w-2/4 h-4 mx-4 bg-neutral-quaternary rounded-base">
                        <div class="h-4 bg-warning rounded-base" style="width:4%"></div>
                    </div>
                    <span class="text-sm font-medium text-body">4%</span>
                </div>
                <div class="flex items-center mt-4">
                    <a href="#" class="text-sm font-medium text-fg-brand hover:underline w-14">1 star</a>
                    <div class="w-2/4 h-4 mx-4 bg-neutral-quaternary rounded-base">
                        <div class="h-4 bg-warning rounded-base" style="width:1%"></div>
                    </div>
                    <span class="text-sm font-medium text-body">1%</span>
                </div>
            </div>

            <!-- Grafik Peminjaman -->
            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">
                    Grafik Peminjaman Bulanan
                </h2>


                <div class="flex items-center mb-3">
                    <div class="flex items-center space-x-1">
                        <svg class="w-5 h-5 text-fg-yellow" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                        <svg class="w-5 h-5 text-fg-yellow" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                        <svg class="w-5 h-5 text-fg-yellow" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                        <svg class="w-5 h-5 text-fg-yellow" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                        <svg class="w-5 h-5 text-fg-disabled" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                    </div>
                    <p class="ms-2 text-sm font-medium text-body">4.95 out of 5</p>
                </div>
                <p class="text-sm font-medium text-body">1,745 global ratings</p>
                <div class="flex items-center mt-4">
                    <a href="#" class="text-sm font-medium text-fg-brand hover:underline w-14">5 star</a>
                    <div class="w-2/4 h-4 mx-4 bg-neutral-quaternary rounded-base">
                        <div class="h-4 bg-warning rounded-base" style="width: 70%"></div>
                    </div>
                    <span class="text-sm font-medium text-body">70%</span>
                </div>
                <div class="flex items-center mt-4">
                    <a href="#" class="text-sm font-medium text-fg-brand hover:underline w-14">4 star</a>
                    <div class="w-2/4 h-4 mx-4 bg-neutral-quaternary rounded-base">
                        <div class="h-4 bg-warning rounded-base" style="width: 17%"></div>
                    </div>
                    <span class="text-sm font-medium text-body">17%</span>
                </div>
                <div class="flex items-center mt-4">
                    <a href="#" class="text-sm font-medium text-fg-brand hover:underline w-14">3 star</a>
                    <div class="w-2/4 h-4 mx-4 bg-neutral-quaternary rounded-base">
                        <div class="h-4 bg-warning rounded-base" style="width: 8%"></div>
                    </div>
                    <span class="text-sm font-medium text-body">8%</span>
                </div>
                <div class="flex items-center mt-4">
                    <a href="#" class="text-sm font-medium text-fg-brand hover:underline w-14">2 star</a>
                    <div class="w-2/4 h-4 mx-4 bg-neutral-quaternary rounded-base">
                        <div class="h-4 bg-warning rounded-base" style="width:4%"></div>
                    </div>
                    <span class="text-sm font-medium text-body">4%</span>
                </div>
                <div class="flex items-center mt-4">
                    <a href="#" class="text-sm font-medium text-fg-brand hover:underline w-14">1 star</a>
                    <div class="w-2/4 h-4 mx-4 bg-neutral-quaternary rounded-base">
                        <div class="h-4 bg-warning rounded-base" style="width:1%"></div>
                    </div>
                    <span class="text-sm font-medium text-body">1%</span>
                </div>

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