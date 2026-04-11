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

// hitung total anggota (level siswa)
$data_anggota = mysqli_query($koneksi, "
    SELECT COUNT(*) as total 
    FROM users 
    WHERE level='siswa'
");

$data_anggota = mysqli_fetch_assoc($data_anggota);
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

// ambil data per bulan
$data_bulanan = mysqli_query($koneksi, "
    SELECT MONTH(created_at) as bulan, COUNT(*) as jumlah 
    FROM users 
    GROUP BY MONTH(created_at)
");

// simpan ke array
$bulan = [];
$jumlah = [];

while ($row = mysqli_fetch_assoc($data_bulanan)) {
    $bulan[] = $row['bulan'];
    $jumlah[] = $row['jumlah'];
}
// grafik peminjaman per bulan
$peminjaman = mysqli_query($koneksi, "
    SELECT MONTH(tanggal_pinjam) as bulan, COUNT(*) as jumlah 
    FROM transaksi 
    GROUP BY MONTH(tanggal_pinjam)
");

// simpan ke array
$bulan_pinjam = [];
$jumlah_pinjam = [];

while ($row = mysqli_fetch_assoc($peminjaman)) {
    $bulan_pinjam[] = $row['bulan'];
    $jumlah_pinjam[] = $row['jumlah'];
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/src/output.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <title>libera admin</title>
</head>


<body class="bg-[#B0FFFA] font-poppins">

    <?php include 'partials/sidebar.php'; ?>

    <!-- KONTEN UTAMA -->
    <main class="ml-60 p-4 min-h-screen">
        <section>
            <div
                class="mt-6 bg-linear-to-r from-[#2563eb] to-[#3b82f6] p-6 rounded-xl shadow text-white flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-semibold mb-1 flex items-center gap-2">
                        <img src="../resources/img/profil.png" class="w-6 h-6 brightness-0 invert">
                        Halo, <?php echo isset($user['nama']) ? $user['nama'] : 'User'; ?>
                    </h2>
                    <p class="text-sm opacity-90">
                        Selamat datang di dashboard admin Libera. Kelola data perpustakaan dengan mudah.
                    </p>
                </div>

            </div>
        </section>

        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">

            <!-- Anggota -->
            <div class="bg-white p-5 rounded-xl shadow hover:shadow-lg transition flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Anggota</p>
                    <h3 class="text-3xl font-bold text-blue-600 mt-2">
                        <?php echo $data_anggota['total']; ?>
                    </h3>
                    <p class="text-xs text-gray-400 mt-1">anggota terdaftar</p>
                </div>
                <img src="../resources/img/anggota.png" class="w-12 h-12 opacity-80">
            </div>

            <!-- Buku -->
            <div class="bg-white p-5 rounded-xl shadow hover:shadow-lg transition flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Buku</p>
                    <h3 class="text-3xl font-bold text-blue-600 mt-2">
                        <?php echo $data_total['total']; ?>
                    </h3>
                    <p class="text-xs text-gray-400 mt-1">buku tersedia</p>
                </div>
                <img src="../resources/img/buku.png" class="w-12 h-12 opacity-80">
            </div>

            <!-- Dipinjam -->
            <div class="bg-white p-5 rounded-xl shadow hover:shadow-lg transition flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Sedang Dipinjam</p>
                    <h3 class="text-3xl font-bold text-blue-600 mt-2">
                        <?php echo number_format($data_pinjam['total']); ?>
                    </h3>
                    <p class="text-xs text-gray-400 mt-1">buku dipinjam</p>
                </div>
                <img src="../resources/img/baca_buku.png" class="w-12 h-12 opacity-80">
            </div>

            <!-- Pengunjung -->
            <div class="bg-white p-5 rounded-xl shadow hover:shadow-lg transition flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Pengunjung</p>
                    <h3 class="text-3xl font-bold text-blue-600 mt-2">
                        <?php echo number_format($data_pengunjung['total']); ?>
                    </h3>
                    <p class="text-xs text-gray-400 mt-1">bulan ini</p>
                </div>
                <img src="../resources/img/pengunjung.png" class="w-12 h-12 opacity-80">
            </div>

        </section>
        <section>
            <div>
                <h2 class="text-lg font-semibold text-gray-700 mb-4 mt-6">
                    Aktivitas Terbaru
                </h2>
                <a href="../admin/notifications.php"
                    class="flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-all shadow-md hover:shadow-lg text-sm">
                    <img src="../resources/img/notif.png" class="w-4 h-4">
                    lihat notifikasi
                </a>

            </div>
        </section>

        <section class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">

            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="text-lg font-semibold mb-4">
                    Grafik Anggota Bulanan
                </h2>

                <canvas id="chartAnggota"></canvas>
            </div>
            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">
                    Grafik Peminjaman Bulanan
                </h2>

                <canvas id="chartPeminjaman"></canvas>
            </div>

        </section>

    </main>

    <script>
        const ctx = document.getElementById('chartAnggota');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($bulan); ?>,
                datasets: [{
                    label: 'Jumlah Anggota',
                    data: <?= json_encode($jumlah); ?>,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script>
const ctxPinjam = document.getElementById('chartPeminjaman');

new Chart(ctxPinjam, {
    type: 'line', // bisa ganti: bar / line
    data: {
        labels: <?= json_encode($bulan_pinjam); ?>,
        datasets: [{
            label: 'Jumlah Peminjaman',
            data: <?= json_encode($jumlah_pinjam); ?>,
            borderWidth: 2,
            tension: 0.3
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
</body>

</html>