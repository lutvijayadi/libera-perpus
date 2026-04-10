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

$query_users = mysqli_query($koneksi, "SELECT id_users, nama FROM users");

// ambil buku
$query_buku = mysqli_query($koneksi, "SELECT id_buku, judul_buku FROM buku");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>libera edit transaksi</title>
</head>

<body>
    <h1>edit transaksi</h1>

    <form action="../aksi/aksi_edit_transaksi.php" method="post">
        <input type="hidden" name="id_transaksi" value="<?php echo $data['id_transaksi']; ?>">

        <!-- USER -->
        <div>
            <label>Nama:</label>
            <select name="id_users" required>
                <option value="">Pilih User</option>
                <?php while ($user = mysqli_fetch_assoc($query_users)) { ?>
                    <option value="<?php echo $user['id_users']; ?>"
                        <?php echo ($user['id_users'] == $data['id_users']) ? 'selected' : ''; ?>>
                        <?php echo $user['nama']; ?>
                    </option>
                <?php } ?>
            </select><br><br>
        </div>

        <!-- BUKU -->
        <div>
            <label>Judul Buku:</label>
            <select name="id_buku" required>
                <option value="">Pilih Buku</option>
                <?php while ($buku = mysqli_fetch_assoc($query_buku)) { ?>
                    <option value="<?php echo $buku['id_buku']; ?>"
                        <?php echo ($buku['id_buku'] == $data['id_buku']) ? 'selected' : ''; ?>>
                        <?php echo $buku['judul_buku']; ?>
                    </option>
                <?php } ?>
            </select><br><br>
        </div>

        <!-- TANGGAL -->
        <div>
            <label>Tanggal Pinjam:</label>
            <input type="date" name="tanggal_pinjam"
                value="<?php echo $data['tanggal_pinjam']; ?>" required><br><br>
        </div>

        <div>
            <label>Tanggal Kembali:</label>
            <input type="date" name="tanggal_kembali"
                value="<?php echo $data['tanggal_kembali']; ?>" required><br><br>
        </div>

       
        <div>
            <label>Status:</label>
            <select name="status" required>
                <option value="menunggu konfirmasi" <?= ($data['status'] == 'menunggu konfirmasi') ? 'selected' : ''; ?>>
                    Menunggu Konfirmasi
                </option>

                <option value="disetujui" <?= ($data['status'] == 'disetujui') ? 'selected' : ''; ?>>
                    Disetujui
                </option>

                <option value="ditolak" <?= ($data['status'] == 'ditolak') ? 'selected' : ''; ?>>
                    Ditolak
                </option>

                <option value="selesai" <?= ($data['status'] == 'selesai') ? 'selected' : ''; ?>>
                    Selesai (Dikembalikan)
                </option>
            </select><br><br>
        </div>

        <div>
            <button type="submit" name="edit">Edit Transaksi</button>
        </div>

    </form>
</body>
</html>