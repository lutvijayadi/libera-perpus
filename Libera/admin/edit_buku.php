<?php
include '../config/koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku = '$id'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Buku - Libera</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-xl shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Data Buku</h1>
        <form action="../aksi/aksi_edit_buku.php" method="post" enctype="multipart/form-data" class="space-y-4">
            <input type="hidden" name="id_buku" value="<?php echo $data['id_buku']; ?>">
            <div>
                <label class="block text-sm font-medium">Judul Buku</label>
                <input type="text" name="judul_buku" value="<?php echo $data['judul_buku']; ?>" required
                    class="w-full p-2 border rounded-md">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Pengarang</label>
                    <input type="text" name="pengarang" value="<?php echo $data['pengarang']; ?>" required
                        class="w-full p-2 border rounded-md">
                </div>
                <div>
                    <label class="block text-sm font-medium">Penerbit</label>
                    <input type="text" name="penerbit" value="<?php echo $data['penerbit']; ?>" required
                        class="w-full p-2 border rounded-md">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" value="<?php echo $data['tahun_terbit']; ?>" required
                        class="w-full p-2 border rounded-md">
                </div>
                <div>
                    <label class="block text-sm font-medium">Stok</label>
                    <input type="number" name="stok" value="<?php echo $data['stok']; ?>" required
                        class="w-full p-2 border rounded-md">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium">Cover Saat Ini</label>
                <img src="../uploads/<?php echo $data['cover']; ?>" class="w-20 h-28 object-cover mb-2 rounded">
                <input type="file" name="cover" class="w-full text-sm text-gray-500">
                <p class="text-xs text-gray-400">*Kosongkan jika tidak ingin mengubah cover</p>
            </div>

            <button type="submit" name="update"
                class="w-full bg-green-600 text-white py-2 rounded-md font-bold hover:bg-green-700">Update Buku</button>
        </form>
    </div>
</body>

</html>