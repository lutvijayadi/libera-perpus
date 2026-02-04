<?php

include '../config/koneksi.php';

if (isset($_POST['tambah'])) {

    $nama   = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kelas  = mysqli_real_escape_string($koneksi, $_POST['kelas']);


    $query = "INSERT INTO anggota (nama, kelas, status) VALUES ('$nama', '$kelas', 'aktif')";

    $insert = mysqli_query($koneksi, $query);

    if ($insert) {
        header("location:../admin/kelola_anggota.php?pesan=berhasil_tambah");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    header("location:../admin/tambah_anggota.php");
}