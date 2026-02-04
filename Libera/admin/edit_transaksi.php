<?php

include '../config/koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>libera edit transaksi</title>
</head>
<body>
    <h1>edit transaksi</h1>
    <form action="../aksi/aksi_edit_transaksi.php" method="post">
        <div>     
            <label for="nama">Nama Anggota:</label>
            <input type="text" id="nama" name="nama" value="<?php echo $data['nama']; ?>" required><br><br>
        </div>
        <div>
            <label for="judul_buku">Judul Buku:</label>
            <input type="text" id="judul_buku" name="judul_buku" value="<?php echo $data['judul_buku']; ?>" required><br><br>
        </div>
        <div>
            <label for="tanggal_pinjam">Tanggal Pinjam:</label>
            <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" value="<?php echo $data['tanggal_pinjam']; ?>" required><br><br>
        </div>
        <div>
            <label for="tanggal_kembali">Tanggal Kembali:</label>
            <input type="date" id="tanggal_kembali" name="tanggal_kembali" value="<?php echo $data['tanggal_kembali']; ?>" required><br><br>
        </div>
        <div>
            <button type="submit" name="edit">Edit Transaksi</button>
        </div>
    </form>
</body>
</html>