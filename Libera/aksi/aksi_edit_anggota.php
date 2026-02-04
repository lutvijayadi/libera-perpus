<?php
include '../config/koneksi.php';

if (isset($_POST['edit'])) {
    $nama_lama = mysqli_real_escape_string($koneksi, $_POST['nama_lama']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);

    $query = "UPDATE anggota SET nama='$nama', kelas='$kelas' WHERE nama='$nama_lama'";
    if (mysqli_query($koneksi, $query)) {
        header("Location: ../admin/kelola_anggota.php?pesan=berhasil_edit");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    header("Location: ../admin/edit_anggota.php");
}
?>