<?php
include '../config/koneksi.php';

if (isset($_POST['tambah'])) {

    $id       = mysqli_real_escape_string($koneksi, $_POST['id_users']);
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kelas    = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $status   = mysqli_real_escape_string($koneksi, $_POST['status']);

    $level = 'siswa';

    // 🔥 CEK ID SUDAH ADA BELUM
    $cek_id = mysqli_query($koneksi, "SELECT * FROM users WHERE id_users='$id'");
    if (mysqli_num_rows($cek_id) > 0) {
        echo "ID sudah digunakan!";
        exit;
    }

    // 🔥 CEK USERNAME
    $cek_user = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek_user) > 0) {
        echo "Username sudah digunakan!";
        exit;
    }

    // INSERT MANUAL ID
    $query = "INSERT INTO users (id_users, nama, kelas, username, password, level, status) 
              VALUES ('$id', '$nama', '$kelas', '$username', '$password', '$level', '$status')";

    if (mysqli_query($koneksi, $query)) {
        header("location:../admin/kelola_anggota.php?pesan=berhasil_tambah");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }

} else {
    header("location:../admin/tambah_anggota.php");
}
?>