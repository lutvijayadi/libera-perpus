<?php

include '../config/koneksi.php';

$nama = $_GET['nama']; 

$query = "DELETE FROM users WHERE nama='$nama'";

if (mysqli_query($koneksi, $query)) {
    header("Location: ../admin/kelola_anggota.php");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>