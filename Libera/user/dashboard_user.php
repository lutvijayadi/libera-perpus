<?php
include '../config/koneksi.php';

// Query untuk menghitung total semua buku
$query_total = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM buku");
$data_total = mysqli_fetch_assoc($query_total);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/feather-icons"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&family=Poppins:wght@100..900&display=swap"
        rel="stylesheet">
    <title>libera admin</title>
</head>

<body class="bg-gray-50">
    <!-- sidebar -->
    <?php include 'partials/sidebar_user.php'; ?>
    <section>
        <div class="ml-60 p-4 justify-between flex items-center bg-[#fFF] shadow-lg">
            <h1 class="font-bold uppercase tracking-wide">
            </h1>
            <div class="flex items-center gap-4">
                <span class="text-sm font-medium">Admin Libera</span>
                <img src="../resources/img/hapidd.png" alt="Admin" class="w-8 h-8 rounded-full border">
            </div>
        </div>
    </section>

    <section class="gap-6 ml-60 p-4 flex">

        <div>
            <div class="bg-white px-9 py-4 rounded-lg shadow-md">
                <h2 class="text-gray-600 text-sm">Total Anggota</h2>
                <p class="my-2 text-2xl font-bold text-gray-800">350</p>
                <p class="md-4 text-xs font-reguler text-gray-600">total anggota terdaftar</p>
            </div>
        </div>
        <div class="mb-auto bg-white px-9 py-4  rounded-lg shadow-md">
            <h2 class="text-gray-600 text-sm">Total Buku</h2>
            <p class="my-2 text-2xl font-bold text-gray-800"><?php echo $data_total['total']; ?></p>
            <p class="md-4 text-xs font-reguler text-gray-600">total buku saat ini</p>
        </div>
        <div class="mb-auto bg-white px-6  py-4  rounded-lg shadow-md">
            <h2 class="text-gray-600 text-sm">Sedang Dipinjam</h2>
            <p class="my-2 text-2xl font-bold text-gray-800">120</p>
            <p class="md-4 text-xs font-reguler text-gray-600">total buku sedang dipinjam</p>
        </div>

    </section>
    <section class="ml-60 p-4 flex mb-auto">
        <div class=" mt-auto bg-white px-9 py-4 rounded-lg shadow-md">
            <h2 class="text-gray-600 text-sm">Total Pengunjung</h2>
            <p class="my-2 text-2xl font-bold text-gray-800">1.250</p>
            <p class="md-4 text-xs font-reguler text-gray-600">total pengunjung bulan ini</p>
        </div>
    </section>

    <script>
        feather.replace();
    </script>
</body>

</html>