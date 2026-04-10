<?php
include '../config/koneksi.php';

// Sesuaikan variabel koneksi dengan file koneksi.php Anda
$db = $koneksi;

if (isset($_POST['submit'])) {
    // 1. Ambil data dari POST (Nama harus sesuai dengan atribut 'name' di HTML)
    $judul_buku = mysqli_real_escape_string($db, $_POST['judul_buku']);
    $pengarang = mysqli_real_escape_string($db, $_POST['pengarang']);
    $penerbit = mysqli_real_escape_string($db, $_POST['penerbit']);
    $tahun_terbit = mysqli_real_escape_string($db, $_POST['tahun_terbit']);
    $kategori = mysqli_real_escape_string($db, $_POST['kategori']);
    $stok = mysqli_real_escape_string($db, $_POST['stok']);
    $cover = $_FILES['cover'];

    // 2. Logika Upload File
    $cover_name = $_FILES['cover']['name'];
    $tmp_name = $_FILES['cover']['tmp_name'];
    $target_dir = "../uploads/";
    $file_extension = pathinfo($cover_name, PATHINFO_EXTENSION);

    // Nama file unik agar tidak bentrok
    $new_file_name = time() . "_" . preg_replace("/[^a-zA-Z0-9]/", "_", $judul_buku) . "." . $file_extension;
    $target_file = $target_dir . $new_file_name;

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if (move_uploaded_file($tmp_name, $target_file)) {
        
            $query = "INSERT INTO buku 
    (judul_buku, pengarang, penerbit, kategori, tahun_terbit, stok, cover)
    VALUES 
    ('$judul_buku', '$pengarang', '$penerbit', '$kategori', '$tahun_terbit', '$stok', '$new_file_name')";

        if (mysqli_query($db, $query)) {
            header("location:../admin/kelola_data_buku.php?pesan=berhasil");
            exit();
        } else {
            echo "Gagal input ke database: " . mysqli_error($db);
        }
    } else {
        header("location:../admin/kelola_data_buku.php?pesan=gagal_upload");
        exit();
    }
} else {
    header("location:../admin/tambah_buku.php");
    exit();
}
?>