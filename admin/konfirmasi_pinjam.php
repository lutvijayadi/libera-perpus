<?php
session_start();
include '../config/koneksi.php';

$id_transaksi = $_GET['id'];

$query = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Tailwind -->
   <link rel="stylesheet" href="../public/src/output.css">

    <title>Konfirmasi Peminjaman</title>
</head>

<body class="bg-[#B0FFFA] font-poppins flex items-center justify-center min-h-screen">

    <div class="w-full max-w-xl bg-white rounded-2xl shadow-xl overflow-hidden">

        <!-- HEADER -->
        <div class="bg-linear-to-r from-[#2563eb] to-[#3b82f6] p-5 text-white flex items-center gap-3">
            <img src="../resources/img/buku.png" class="w-6 h-6">
            <h2 class="text-lg font-semibold">Detail Persetujuan Pinjam</h2>
        </div>

        <!-- CONTENT -->
        <div class="p-6 text-gray-700">

            <div class="space-y-4 text-sm">

                <div class="flex justify-between border-b pb-2">
                    <span class="text-gray-500 flex items-center gap-2">
                        <img src="../resources/img/baca_buku.png" class="w-4 h-4"> Peminjam
                    </span>
                    <span class="font-semibold"><?php echo $data['nama']; ?></span>
                </div>

                <div class="flex justify-between border-b pb-2">
                    <span class="text-gray-500 flex items-center gap-2">
                        <img src="../resources/img/buku.png" class="w-4 h-4"> Buku
                    </span>
                    <span class="font-semibold"><?php echo $data['judul_buku']; ?></span>
                </div>

                <div class="flex justify-between border-b pb-2">
                    <span class="text-gray-500 flex items-center gap-2">
                        <img src="../resources/img/layers.png" class="w-4 h-4"> Jumlah
                    </span>
                    <span class="font-semibold"><?php echo $data['total_pinjam']; ?></span>
                </div>

                <div class="flex justify-between items-center border-b pb-3">
                    <span class="text-blue-600 font-medium flex items-center gap-2">
                        <img src="../resources/img/info.png" class="w-4 h-4"> Status
                    </span>
                    <span class="px-3 py-1 rounded-lg text-xs bg-yellow-200 text-yellow-800 shadow-sm">
                        <?php echo $data['status']; ?>
                    </span>
                </div>

            </div>

            <!-- BUTTON -->
            <form action="../aksi/aksi_update_status.php" method="POST" class="flex gap-4 mt-6">
                <input type="hidden" name="id_transaksi" value="<?php echo $data['id_transaksi']; ?>">
                
                <button type="submit" name="action" value="disetujui"
                    class="flex-1 bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 transition shadow-lg flex items-center justify-center gap-2">
                    Setujui
                </button>
                
                <button type="submit" name="action" value="ditolak" 
                    class="flex-1 bg-red-500 text-white py-3 rounded-xl hover:bg-red-600 transition shadow-lg flex items-center justify-center gap-2">
                    Tolak
                </button>
            </form>

            <!-- FOOTER -->
            <div class="text-center mt-6">
                <a href="notifications.php" class="text-blue-600 hover:underline text-sm flex items-center justify-center gap-1">
                    <img src="icon/arrow-left.png" class="w-4 h-4">
                    Kembali ke Notifikasi
                </a>
            </div>

        </div>
    </div>

</body>
</html>