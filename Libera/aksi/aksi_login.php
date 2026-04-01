<?php
session_start();
include '../config/koneksi.php';

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = mysqli_real_escape_string($koneksi, $_POST['password']);

// cek user
$login = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");

if (mysqli_num_rows($login) == 1) {
    $data = mysqli_fetch_assoc($login);

    // ✅ SESSION WAJIB
    $_SESSION['id_users'] = $data['id_users'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['nama']     = $data['nama'];
    $_SESSION['level']    = $data['level'];

    // redirect
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