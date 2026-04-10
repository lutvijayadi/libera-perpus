<?php

include '../config/koneksi.php';

$id = $_GET['id']; 

$query = "DELETE FROM buku WHERE id_buku='$id'";

if (mysqli_query($koneksi, $query)) {
    header("Location: ../admin/kelola_data_buku.php");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>