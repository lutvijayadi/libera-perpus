<?php

include '../config/koneksi.php';

$judul_buku = $_GET['judul_buku']; 

$query = "DELETE FROM buku WHERE judul_buku='$judul_buku'";

if (mysqli_query($koneksi, $query)) {
    header("Location: ../admin/kelola_data_buku.php");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>