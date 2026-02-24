<?php

include '../config/koneksi.php';

if (isset($_POST['daftar'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);


    $query = "INSERT INTO users (username, password, nama) VALUES ('$username', '$password', '$nama')";

    $insert = mysqli_query($koneksi, $query);

    if ($insert) {
        header("location:../auth/login.php?pesan=berhasil_registrasi");
    } else {
        header("location:../auth/registrasiuser.php?pesan=gagal_registrasi");
    }
} else {

    header("location:../auth/registrasiuser.php");
}
?>