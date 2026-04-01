<?php
session_start();
include '../config/koneksi.php';

// Ambil ID dari URL (yang dikirim dari klik notifikasi)
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
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Konfirmasi Peminjaman</title>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-md mx-auto bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-xl font-bold mb-4">Detail Persetujuan Pinjam</h2>
        <div class="space-y-2 mb-6">
            <p><strong>Peminjam:</strong> <?php echo $data['nama']; ?></p>
            <p><strong>Buku:</strong> <?php echo $data['judul_buku']; ?></p>
            <p><strong>Jumlah:</strong> <?php echo $data['total_pinjam']; ?></p>
            <p><strong>Status Saat Ini:</strong> 
                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-sm"><?php echo $data['status']; ?></span>
            </p>
        </div>

        <form action="aksi_update_status.php" method="POST" class="flex gap-2">
            <input type="hidden" name="id_transaksi" value="<?php echo $data['id_transaksi']; ?>">
            
            <button type="submit" name="action" value="Disetujui" 
                class="flex-1 bg-green-500 text-white py-2 rounded hover:bg-green-600 transition">
                Setujui
            </button>
            
            <button type="submit" name="action" value="Ditolak" 
                class="flex-1 bg-red-500 text-white py-2 rounded hover:bg-red-600 transition">
                Tolak
            </button>
        </form>
        <a href="notifikasi.php" class="block text-center mt-4 text-gray-500 text-sm">Kembali</a>
    </div>
</body>
</html>