<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>libera tambah anggota</title>
</head>

<body>
    <h1>Tambah Anggota</h1>
    <form action="../aksi/aksi_tambah_anggota.php" method="post">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required><br><br>

        <label for="kelas">Kelas:</label>
        <input type="text" id="kelas" name="kelas" required><br><br>

        </select><br><br>

        <button type="submit" name="tambah">Tambah Anggota</button>
    </form>
</body>

</html>