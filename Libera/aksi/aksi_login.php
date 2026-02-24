<?php
session_start();

include '../config/koneksi.php';

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = mysqli_real_escape_string($koneksi, $_POST['password']);


$login = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
$cek = mysqli_num_rows($login) == 1;
if ($cek) {

    $data = mysqli_fetch_assoc($login);

    // login sebagai admin
    if ($data['level'] == "admin") {


        $_SESSION['username'] = $username;
        $_SESSION['level'] = "admin";   

        header("location:../admin/dashboard.php");

        // login sebagai user
    } else if ($data['level'] == "siswa") {

        $_SESSION['username'] = $username;
        $_SESSION['level'] = "siswa";

        header("location:../user/dashboard_user.php");

    } else {

        // alihkan ke halaman login kembali
        header("location:../resources/view/login.php?pesan=gagal");
    }
} else {
    header("location:../index/index.php?pesan=gagal");
}

?>