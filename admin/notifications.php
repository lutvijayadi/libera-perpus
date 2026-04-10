<?php
session_start();
include '../config/koneksi.php';

$username = $_SESSION['username'];
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM users WHERE username='$username'"
);
$user = mysqli_fetch_assoc($query);

if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit;
}

// Query to fetch all notifications
$query_notif = mysqli_query($koneksi, "SELECT * FROM notif ORDER BY created_at DESC");
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
    <title>Notifikasi - Libera Admin</title>
</head>

<body class="bg-[#B0FFFA] font-poppins">

    <?php include 'partials/sidebar.php'; ?>

    <!-- KONTEN UTAMA -->
    <main class="ml-60 p-4 min-h-screen">
        <section>
            <div class="mt-6 bg-gradient-to-r from-blue-600 to-blue-500 p-6 rounded-xl shadow text-white">
                <h2 class="text-2xl font-semibold mb-1">
                    Notifikasi
                </h2>
                <p class="text-sm opacity-90">
                    Lihat semua aktivitas peminjaman buku oleh pengguna.
                </p>
            </div>
        </section>

        <section class="mt-6">
            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">
                    Daftar Notifikasi
                </h2>
                <?php if (mysqli_num_rows($query_notif) > 0): ?>
                    <div class="space-y-4">
                        <?php while ($notif = mysqli_fetch_assoc($query_notif)): ?>
                            <?php
                            // Jika id_transaksi tidak ada atau 0, gunakan link alternatif atau sembunyikan
                            $link_target = isset($notif['id_transaksi']) && !empty($notif['id_transaksi'])
                                ? "konfirmasi_pinjam.php?id=" . $notif['id_transaksi']
                                : "transaksi.php";
                            ?>
                            <a href="<?php echo $link_target; ?>"
                                class="block bg-gray-50 rounded-lg p-4 border-l-4 border-blue-500 hover:bg-blue-50 transition duration-200 shadow-sm">

                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-xs text-gray-400">
                                            <?php echo date('d M Y, H:i', strtotime($notif['created_at'])); ?>
                                        </p>
                                        <p class="mt-1 text-gray-700 font-medium">
                                            <?php echo htmlspecialchars($notif['message']); ?>
                                        </p>
                                    </div>
                                    <span class="text-blue-500 text-sm font-semibold flex items-center gap-1">
                                        Proses <img src="../resources/img/proses.png" class="w-4 h-4">
                                    </span>
                                </div>
                            </a>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-10">
                        <p class="text-gray-500 italic">Belum ada notifikasi.</p>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <script>
        feather.replace();
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>

</html>