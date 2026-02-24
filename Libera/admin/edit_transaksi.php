<?php

include '../config/koneksi.php';

if (!isset($_GET['id_transaksi'])) {
    echo "ID Transaksi tidak ditemukan!";
    exit;
}

$id = $_GET['id_transaksi'];

$query = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_transaksi = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data transaksi tidak ditemukan!";
    exit;
}

// Fetch anggota for dropdown
$query_anggota = mysqli_query($koneksi, "SELECT id_anggota, nama FROM anggota");

// Fetch buku for dropdown
$query_buku = mysqli_query($koneksi, "SELECT id_buku, judul_buku FROM buku");
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
        <input type="hidden" name="id_transaksi" value="<?php echo $data['id_transaksi']; ?>">
        <div>
            <label for="id_anggota">Nama Anggota:</label>
            <select id="id_anggota" name="id_anggota" required>
                <option value="">Pilih Anggota</option>
                <?php while ($anggota = mysqli_fetch_assoc($query_anggota)) { ?>
                    <option value="<?php echo $anggota['id_anggota']; ?>" <?php echo ($anggota['id_anggota'] == $data['id_anggota']) ? 'selected' : ''; ?>><?php echo $anggota['nama']; ?>
                    </option>
                <?php } ?>
            </select><br><br>
        </div>
        <div>
            <label for="id_buku">Judul Buku:</label>
            <select id="id_buku" name="id_buku" required>
                <option value="">Pilih Buku</option>
                <?php while ($buku = mysqli_fetch_assoc($query_buku)) { ?>
                    <option value="<?php echo $buku['id_buku']; ?>" <?php echo ($buku['id_buku'] == $data['id_buku']) ? 'selected' : ''; ?>><?php echo $buku['judul_buku']; ?></option>
                <?php } ?>
            </select><br><br>
        </div>
        <div>
            <label for="tanggal_pinjam">Tanggal Pinjam:</label>
            <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" value="<?php echo $data['tanggal_pinjam']; ?>"
                required><br><br>
        </div>
        <div>
            <label for="tanggal_kembali">Tanggal Kembali:</label>
            <input type="date" id="tanggal_kembali" name="tanggal_kembali"
                value="<?php echo $data['tanggal_kembali']; ?>" required><br><br>
        </div>
        <div>
            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="0" <?php echo ($data['status'] == 0) ? 'selected' : ''; ?>>Menunggu Konfirmasi</option>
                <option value="1" <?php echo ($data['status'] == 1) ? 'selected' : ''; ?>>Disetujui</option>
                <option value="2" <?php echo ($data['status'] == 2) ? 'selected' : ''; ?>>Ditolak</option>
            </select><br><br>
        </div>
        <div>
            <button type="submit" name="edit">Edit Transaksi</button>
        </div>
    </form>
</body>

</html>