<?php

include '../config/koneksi.php';

$id = $_GET['id']; 

$query = "DELETE FROM transaksi WHERE id='$id'";

if (mysqli_query($koneksi, $query)) {
    header("Location: ../admin/transaksi.php");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>