<?php
session_start();
include "../config/koneksi.php";

$id = $_POST['id_user'];
$username = $_POST['username'];

// upload foto
$nama_file = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];

if ($nama_file != '') {
    $folder = "../resources/img/";
    $path = $folder . basename($nama_file);

    move_uploaded_file($tmp, $path);

    $query = "UPDATE users SET username='$username', foto='$nama_file' WHERE id_user='$id'";
} else {
    $query = "UPDATE users SET username='$username' WHERE id_user='$id'";
}

mysqli_query($koneksi, $query);

// update session juga biar langsung berubah
$_SESSION['username'] = $username;

header("location:profil.php?success=1");