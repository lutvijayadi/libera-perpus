<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/feather-icons"></script>

    <title>Libera pengembalian buku</title>
</head>
<body>
    <!-- sidebar -->
    <?php include 'partials/sidebar_user.php'; ?>

    <!-- conten utama -->

    <main class="mt-20 p-8">
        <h1 class="text-2xl font-bold mb-6">Pengembalian Buku</h1>
        <form action="../aksi/aksi_pengembalian_buku.php" method="post">
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Peminjam:</label>
                <input type="text" id="nama" name="nama" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div>
                <label for="judul_buku" class="block text-sm font-medium text-gray-700">Judul Buku:</label>
                <input type="text" id="judul_buku" name="judul_buku" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div>
                <label for="tanggal_kembali" class="block text-sm font-medium text-gray-700">Tanggal Kembali:</label>
                <input type="date" id="tanggal_kembali" name="tanggal_kembali" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <button type="submit" name="kembalikan" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Kembalikan Buku</button>
        </form>
    </main>
    <script>
        feather.replace();
    </script>
</body>
</html>