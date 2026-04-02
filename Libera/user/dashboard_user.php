<?php
include '../config/koneksi.php';

session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}
$query_buku = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY id_buku DESC");
$username = $_SESSION['username'];

$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
$user = mysqli_fetch_assoc($query);

// total buku
$total_buku = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM buku"))['total'];

// total user
$total_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM users"))['total'];

// total transaksi
$total_pinjam = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM transaksi"))['total'];


?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body class="bg-[#B0FFFA] font-poppins">

    <?php include 'partials/sidebar_user.php'; ?>

    <!-- HEADER -->
    <main class=" p-6 m-4">
        <section >
            <div class="p-6 bg-gradient-to-r from-blue-600 to-blue-500 rounded-xl shadow text-white">
                <h2 class="text-2xl font-semibold mb-1">
                    Halo, <?php echo isset($user['nama']) ? $user['nama'] : 'User'; ?>
                </h2>
                <p class="text-sm opacity-90">
                    Selamat datang di selamat datang siswa smk al-madani, silakan pilih buku yang ingin di pinjam
                </p>
            </div>
        </section>
        <!-- CARDS -->
        <section>

            <div class=" mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- USER -->
                <div class="bg-blue-500 text-white p-5 rounded-xl shadow hover:scale-105 transition">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm">Total User</p>
                            <h2 class="text-2xl font-bold"><?= $total_user ?></h2>
                        </div>
                        <i data-feather="users"></i>
                    </div>
                </div>

                <!-- BUKU -->
                <div class="bg-green-500 text-white p-5 rounded-xl shadow hover:scale-105 transition">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm">Total Buku</p>
                            <h2 class="text-2xl font-bold"><?= $total_buku ?></h2>
                        </div>
                        <i data-feather="book"></i>
                    </div>
                </div>

                <!-- TRANSAKSI -->
                <div class="bg-yellow-500 text-white p-5 rounded-xl shadow hover:scale-105 transition">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm">Total Peminjaman</p>
                            <h2 class="text-2xl font-bold"><?= $total_pinjam ?></h2>
                        </div>
                        <i data-feather="repeat"></i>
                    </div>
                </div>

        </section>
        
        <section class="mt-6">

            <h2 class="text-xl font-semibold text-gray-700 mb-4">Data Buku</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                <?php while ($buku = mysqli_fetch_assoc($query_buku)) { ?>
                    <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">

                        <!-- Cover -->
                        <div class="h-48 bg-blue-50 flex items-center justify-center">
                            <?php if (!empty($buku['cover'])) { ?>
                                <img src="../uploads/<?php echo $buku['cover']; ?>" class="h-full object-cover">
                            <?php } else { ?>
                                <span class="text-blue-400 text-sm">No Cover</span>
                            <?php } ?>
                        </div>

                        <!-- Isi -->
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-800 truncate">
                                <?php echo $buku['judul_buku']; ?>
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                <?php echo $buku['pengarang']; ?>
                            </p>

                            <div class="flex justify-between items-center mt-3">
                                <span class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded-full">
                                    <?php echo $buku['penerbit']; ?>
                                </span>

                                <span class="text-xs font-semibold 
                                <?php echo ($buku['stok'] > 0) ? 'text-green-600' : 'text-red-500'; ?>">
                                    Stok: <?php echo $buku['stok']; ?>
                                </span>
                            </div>

                            <!-- tombol -->
                            <div class="mt-4">
                                <a href="pinjam_buku.php?id=<?php echo $buku['id_buku']; ?>"
                                    class="block text-center text-sm bg-blue-600 text-white py-1.5 rounded-lg hover:bg-blue-700">
                                    Pinjam
                                </a>
                            </div>

                        </div>
                    </div>
                <?php } ?>

            </div>
        </section>
    </main>
    </div>

    <script>
        feather.replace();
    </script>

</body>

</html>