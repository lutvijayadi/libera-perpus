<?php

include '../config/koneksi.php';

if (isset($_POST['edit'])) {

    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $judul_buku = mysqli_real_escape_string($koneksi, $_POST['judul_buku']);
    $tanggal_pinjam = mysqli_real_escape_string($koneksi, $_POST['tanggal_pinjam']);
    $tanggal_kembali = mysqli_real_escape_string($koneksi, $_POST['tanggal_kembali']);

    $query = "UPDATE transaksi SET nama='$nama', judul_buku='$judul_buku', tanggal_pinjam='$tanggal_pinjam', tanggal_kembali='$tanggal_kembali' WHERE judul_buku='$judul_buku'";

    $update = mysqli_query($koneksi, $query);

    if ($update) {
        header("location:../admin/transaksi.php?pesan=berhasil_edit");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    header("location:../admin/edit_transaksi.php");
}
