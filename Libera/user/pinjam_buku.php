<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjam Buku</title>
</head>
<body>
    <main>
        <section>
            <div>
                <h1>Pinjam Buku</h1>
                <form action="../aksi/aksi_peminjaman_buku.php" method="post">
                    <div>
                        <label for="total_pinjam">Total Pinjam:</label>
                        <input type="number" id="total_pinjam" name="total_pinjam" required>
                    </div>
                    <div>
                        <label for="tanggal_pinjam">Tanggal Pinjam:</label>
                        <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" required>
                    </div>
                    <div>
                        <label for="tanggal_kembali">Tanggal Kembali:</label>
                        <input type="date" id="tanggal_kembali" name="tanggal_kembali" required>
                    </div>
                    <div>
                        <label for="status">Status:</label>
                        <input type="text" id="status" name="status" value="Dipinjam" readonly>
                    </div>
                    <div>
                        <label for="judul_buku">Judul Buku:</label>
                        <input type="text" id="judul_buku" name="judul_buku" value="<?php echo $_GET['id']; ?>" readonly>
                    </div>
                    <button type="submit" name="pinjam">Pinjam Buku</button>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
