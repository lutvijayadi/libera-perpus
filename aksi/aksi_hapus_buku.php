<?php
include '../config/koneksi.php';

$id = $_GET['id'];

// cek apakah buku dipakai di transaksi
$cek = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_buku = '$id'");
if (mysqli_num_rows($cek) > 0) {
    echo "<script>
        alert('Buku tidak bisa dihapus karena masih ada transaksi!');
        window.location='../admin/kelola_data_buku.php';
    </script>";
    exit;
}

// kalau aman baru hapus
mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku = '$id'");

echo "<script>
    alert('Buku berhasil dihapus!');
    window.location='../admin/kelola_data_buku.php';
</script>";