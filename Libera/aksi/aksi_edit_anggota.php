<?php
include '../config/koneksi.php';

if (isset($_POST['edit'])) {

    $id = mysqli_real_escape_string($koneksi, $_POST['id_users']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);

    $query = "UPDATE users 
              SET nama='$nama', kelas='$kelas', status='$status' 
              WHERE id_users='$id'";

    if (mysqli_query($koneksi, $query)) {
        header("Location: ../admin/kelola_anggota.php?pesan=berhasil_edit");
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }

} else {
    header("Location: ../admin/kelola_anggota.php");
    exit;
}
?>