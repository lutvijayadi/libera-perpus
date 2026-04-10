<?php
include '../config/koneksi.php';

if (isset($_GET['id'])) {

    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $cek = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_users='$id'");

    if (mysqli_num_rows($cek) > 0) {
        echo "Data tidak bisa dihapus karena masih digunakan di transaksi!";
        exit;
    }
    $hapus = mysqli_query($koneksi, "DELETE FROM users WHERE id_users='$id'");

    if ($hapus) {
        header("Location: ../admin/kelola_anggota.php?pesan=berhasil_hapus");
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    header("Location: ../admin/kelola_anggota.php");
}
?>