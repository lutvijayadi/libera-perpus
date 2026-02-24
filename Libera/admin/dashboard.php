<?php
session_start();
include '../config/koneksi.php';

// Query untuk menghitung total semua buku
$query_total = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM buku");
$data_total = mysqli_fetch_assoc($query_total);


$username = $_SESSION['username'];
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM users WHERE username='$username'"
);
$user = mysqli_fetch_assoc($query);

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}


$query_aktivitas = mysqli_query($koneksi, "
    SELECT p.*, u.nama, p.judul_buku
    FROM transaksi p
    JOIN users u ON p.nama = u.username
    JOIN buku b ON p.judul_buku = b.judul_buku
    ORDER BY p.tanggal_pinjam DESC
    LIMIT 5
");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/feather-icons"></script>

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
                <h3 class="text-3xl font-bold text-blue-600 mt-2">350</h3>
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
                <h3 class="text-3xl font-bold text-blue-600 mt-2">120</h3>
                <p class="text-xs text-gray-400 mt-1">buku dipinjam</p>
            </div>

            <!-- Pengunjung -->
            <div class="bg-white p-5 rounded-xl shadow hover:shadow-lg transition">
                <p class="text-sm text-gray-500">Total Pengunjung</p>
                <h3 class="text-3xl font-bold text-blue-600 mt-2">1.250</h3>
                <p class="text-xs text-gray-400 mt-1">bulan ini</p>
            </div>
        </section>
        <section>
            <div>
                <h2 class="text-lg font-semibold text-gray-700 mb-4 mt-6">
                    Aktivitas Terbaru
                </h2>

                <?php if (mysqli_num_rows($query_aktivitas) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($query_aktivitas)): ?>
                            <a href="edit_transaksi.php?id_=<?php echo $row['id_transaksi']; ?>" class="block">
                                    <div class="bg-white rounded-xl shadow p-4 hover:shadow-lg transition mb-3">
                                        <p class="text-sm text-gray-500">
                                            <?php echo date('d F Y, H:i', strtotime($row['tanggal_pinjam'])); ?>
                                        </p>

                                        <p class="mt-1 text-gray-700">
                                            <?php echo $row['nama']; ?> meminjam
                                            "<strong><?php echo $row['judul_buku']; ?></strong>"

                                            <?php if ($row['status'] == 0): ?>
                                                    <span class="text-yellow-500 text-sm">(Menunggu Konfirmasi)</span>
                                            <?php elseif ($row['status'] == 1): ?>
                                                    <span class="text-green-600 text-sm">(Disetujui)</span>
                                            <?php else: ?>
                                                    <span class="text-red-500 text-sm">(Ditolak)</span>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                </a>
                        <?php endwhile; ?>
                <?php else: ?>
                        <p class="text-gray-500">Belum ada aktivitas peminjaman.</p>
                <?php endif; ?>
            </div>
        </section>

        <section class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
            <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">
                    Grafik Pengunjung Bulanan
                </h2>
                <div class="h-64 flex items-center justify-center text-gray-400 hover:shadow-lg transition">

                </div>
            </div>

            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">
                    Grafik Peminjaman Bulanan
                </h2>
                <div class="h-64 flex items-center justify-center text-gray-400">

                </div>
            </div>
        </section>

    </main>

    <!-- akhir conten -->

    <script>
        feather.replace();
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>

</html>