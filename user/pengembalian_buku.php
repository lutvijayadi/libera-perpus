
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
        <?php
        include '../config/koneksi.php';

        // ambil transaksi yang masih dipinjam
        $query = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE status='disetujui'");
        ?>

        <form action="../aksi/aksi_pengembalian_buku.php" method="post">

            <div class="mb-4">
                <label>Pilih Transaksi:</label>
                <select name="id_transaksi" required class="w-full p-2 border rounded">
                    <option value="">-- Pilih --</option>
                    <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                        <option value="<?= $row['id_transaksi']; ?>">
                            <?= $row['nama']; ?> - <?= $row['judul_buku']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div>
                <label>Tanggal Kembali:</label>
                <input type="date" name="tanggal_kembali" required class="w-full p-2 border rounded">
            </div>

            <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">
                Kembalikan Buku
            </button>

        </form>
    </main>
    <script>
        feather.replace();
    </script>
</body>

</html>