<?php
include '../config/koneksi.php';

if (isset($_POST['edit'])) {

    $id_transaksi = $_POST['id_transaksi'];
    $id_buku = $_POST['id_buku'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $status = $_POST['status'];


    $data = mysqli_fetch_assoc(mysqli_query($koneksi, "
        SELECT * FROM transaksi WHERE id_transaksi='$id_transaksi'
    "));

    $total_pinjam = $data['total_pinjam'];


    mysqli_query($koneksi, "UPDATE transaksi SET 
        id_buku='$id_buku',
        tanggal_pinjam='$tanggal_pinjam',
        tanggal_kembali='$tanggal_kembali',
        status='$status'
        WHERE id_transaksi='$id_transaksi'
    ");


    if ($status == 'selesai') {

        mysqli_query($koneksi, "
            UPDATE buku 
            SET stok = stok + $total_pinjam 
            WHERE id_buku='$id_buku'
        ");
    }

    header("location:../admin/transaksi.php?pesan=berhasil_edit");
    exit;

} else {
    header("location:../admin/edit_transaksi.php");
}
?>