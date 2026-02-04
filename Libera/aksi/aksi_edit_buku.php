<?php
include '../config/koneksi.php';

if (isset($_POST['update'])) {

    $judul_buku  = mysqli_real_escape_string($koneksi, $_POST['judul_buku']);
    $pengarang  = mysqli_real_escape_string($koneksi, $_POST['pengarang']);
    $stok    = $_POST['stok'];

    $cover_name = $_FILES['cover']['name'];
    $tmp_name   = $_FILES['cover']['tmp_name'];

    if ($cover_name != "") {
        // 1. Jika ganti gambar, hapus gambar lama dulu
        $query_lama = mysqli_query($koneksi, "SELECT cover FROM buku WHERE judul_buku = '$judul_buku'");
        $data_lama  = mysqli_fetch_assoc($query_lama);
        unlink("../uploads/" . $data_lama['cover']);

        // 2. Upload gambar baru
        $new_name = time() . "_" . $cover_name;
        move_uploaded_file($tmp_name, "../uploads/" . $new_name);

        // 3. Update dengan gambar baru
        $sql = "UPDATE buku SET judul_buku='$judul_buku', pengarang='$pengarang', stok='$stok', cover='$new_name' WHERE judul_buku='$judul_buku'";
    } else {
        // 4. Update tanpa ganti gambar
        $sql = "UPDATE buku SET judul_buku='$judul_buku', pengarang='$pengarang', stok='$stok' WHERE judul_buku='$judul_buku'";
    }

    if (mysqli_query($koneksi, $sql)) {
        header("location:../admin/kelola_data_buku.php?pesan=update_berhasil");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>