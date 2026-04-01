<?php
include '../config/koneksi.php';

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

<body class="bg-gray-100">

    <?php include 'partials/sidebar_user.php'; ?>

    <!-- HEADER -->
    <div class="ml-60 p-4 flex justify-between items-center bg-white shadow">
        <h1 class="font-bold text-lg">Dashboard</h1>
        <div class="flex items-center gap-3">
            <span>Admin</span>
            <img src="../resources/img/hapidd.png" class="w-8 h-8 rounded-full">
        </div>
    </div>

    <!-- CARDS -->
    <div class="ml-60 p-6 grid grid-cols-1 md:grid-cols-3 gap-6">

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

    </div>

    <script>
        feather.replace();
    </script>

</body>

</html>