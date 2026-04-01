<?php
include '../config/koneksi.php';

if (isset($_POST['daftar'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    // Menggunakan password_hash (Sangat disarankan untuk keamanan)
    $password_raw = $_POST['password']; 
    $password_hashed = password_hash($password_raw, PASSWORD_DEFAULT);
    $level = "siswa"; // Set level default

    // Mulai Transaksi
    mysqli_begin_transaction($koneksi);

    try {
        // 1. Simpan ke tabel users (untuk login)
        // Pastikan kolom di tabel users sesuai (username, password, level)
        $query_user = "INSERT INTO users (username, password, level) VALUES ('$username', '$password_hashed', '$level')";
        mysqli_query($koneksi, $query_user);

        // 2. Simpan ke tabel anggota (untuk data profil perpustakaan)
        // Kita gunakan variabel $nama untuk kolom nama di tabel anggota
        $query_anggota = "INSERT INTO anggota (nama) VALUES ('$nama')";
        mysqli_query($koneksi, $query_anggota);

        // Jika kedua query berhasil, simpan permanen
        mysqli_commit($koneksi);

        header("location:../auth/login.php?pesan=berhasil_registrasi");
        exit;

    } catch (Exception $e) {
        // Jika ada error, batalkan semua perubahan di database
        mysqli_rollback($koneksi);
        header("location:../auth/registrasiuser.php?pesan=gagal_registrasi");
        exit;
    }

} else {
    header("location:../auth/registrasiuser.php");
    exit;
}
?>