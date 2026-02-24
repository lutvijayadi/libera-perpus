<?php

include '../config/koneksi.php';

$query_buku = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY id_buku DESC");
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
    <title>libera data buku</title>
</head>

<body>
    <!-- sidebar -->
    <?php include 'partials/sidebar_user.php'; ?>

    <!-- konten utama -->
    <main class="ml-60 p-4 min-h-screen">
        <section class="mt-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Data Buku</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php while ($buku = mysqli_fetch_assoc($query_buku)) { ?>
                    <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">

                        <!-- Cover Buku -->
                        <div class="h-48 bg-blue-50 flex items-center justify-center">
                            <?php if (!empty($buku['cover'])) { ?>
                                <img src="../uploads/<?php echo $buku['cover']; ?>" class="h-full object-cover">
                            <?php } else { ?>
                                <span class="text-blue-400 text-sm">No Cover</span>
                            <?php } ?>
                            </div>

                            <!-- Isi Card -->
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800 truncate">
                                    <?php echo $buku['judul_buku']; ?>
                                </h3>

                                <div class="flex justify-between items-center mt-3">
                                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded-full">
                                        <?php echo $buku['penerbit']; ?>
                                    </span>

                                    <span class="text-xs font-semibold 
                            <?php echo ($buku['stok'] > 0) ? 'text-green-600' : 'text-red-500'; ?>">
                                        Stok: <?php echo $buku['stok']; ?>
                                    </span>
                                </div>

                                <!-- Tombol -->
                                <div class="mt-4 flex gap-2">
                                    <a href="../user/pinjam_buku.php?id=<?php echo $buku['judul_buku']; ?>"
                                        class="flex-1 text-center text-sm bg-blue-600 text-white py-1.5 rounded-lg hover:bg-blue-700">
                                        pinjam
                                    </a>

                                    <a href="hapus_buku.php?id=<?php echo $buku['judul_buku']; ?>"
                                        onclick="return confirm('Hapus buku ini?')"
                                        class="flex-1 text-center text-sm bg-red-500 text-white py-1.5 rounded-lg hover:bg-red-600">
                                        Hapus
                                    </a>
                                </div>
                            </div>
                            </div>
                    <?php } ?>
            </div>
        </section>
    </main>
    <script>
        feather.replace();
    </s
cript>
</body>
</html>