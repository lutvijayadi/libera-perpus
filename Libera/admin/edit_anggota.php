<?php
include '../config/koneksi.php';

$id = $_GET['nama'];
$query = mysqli_query($koneksi, "SELECT * FROM anggota WHERE nama = '$id'");
$data = mysqli_fetch_assoc($query);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>libera edit anggota</title>
</head>

<body class="bg-[#B0FFFA]">
    <h1>edit anggota</h1>
    <form action="../aksi/aksi_edit_anggota.php" method="post">
        <input type="hidden" name="nama_lama" value="<?php echo $data['nama']; ?>">
        <div>
            <label class="block text-sm font-medium">Nama</label>
            <input type="text" name="nama" value="<?php echo $data['nama']; ?>" required
                class="w-full p-2 border rounded-md">
        </div>
        <div>
            <label class="block text-sm font-medium">Kelas</label>
            <input type="text" name="kelas" value="<?php echo $data['kelas']; ?>" required
                class="w-full p-2 border rounded-md">
        </div>


        <button type="submit" name="edit">Edit Anggota</button>
</body>

</html>