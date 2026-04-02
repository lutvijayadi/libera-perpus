<?php
session_start();
include '../config/koneksi.php';

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = $_POST['password'];

$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
$data = mysqli_fetch_assoc($query);

if ($data && $password == $data['password']) {

    $_SESSION['id_users'] = $data['id_users'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['level'] = $data['level'];

    if ($data['level'] == "admin") {
        header("location:../admin/dashboard.php");
    } else {
        header("location:../user/dashboard_user.php");
    }
    exit;

} else {
    header("location:../index/index.php?pesan=gagal");
    exit;
}