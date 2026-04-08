<?php
include '../config/koneksi.php';

if (isset($_POST['daftar'])) {

    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);

    $level = "siswa";
    $status = "aktif";

    // cek username
    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Username sudah digunakan!');history.back();</script>";
        exit;
    }

    mysqli_query($koneksi, "INSERT INTO users 
    (nama, username, password, kelas, level, status) 
    VALUES 
    ('$nama', '$username', '$password', '$kelas', '$level', '$status')");

    header("location:../auth/login.php?pesan=berhasil");
    exit;
}
?>