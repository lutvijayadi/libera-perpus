<?php

include '../config/koneksi.php';

if (isset($_POST['edit'])) {

    $id_transaksi = mysqli_real_escape_string($koneksi, $_POST['id_transaksi']);
    $id_anggota = mysqli_real_escape_string($koneksi, $_POST['id_anggota']);
    $id_buku = mysqli_real_escape_string($koneksi, $_POST['id_buku']);
    $tanggal_pinjam = mysqli_real_escape_string($koneksi, $_POST['tanggal_pinjam']);
    $tanggal_kembali = mysqli_real_escape_string($koneksi, $_POST['tanggal_kembali']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);

    $query = "UPDATE transaksi SET id_anggota='$id_anggota', id_buku='$id_buku', tanggal_pinjam='$tanggal_pinjam', tanggal_kembali='$tanggal_kembali', status='$status' WHERE id_transaksi='$id_transaksi'";

    $update = mysqli_query($koneksi, $query);

    if ($update) {
        header("location:../admin/transaksi.php?pesan=berhasil_edit");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    header("location:../admin/edit_transaksi.php");
}
