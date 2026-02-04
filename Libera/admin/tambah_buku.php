<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku - Perpus Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-xl shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Tambah Koleksi Buku</h1>
        <form action="../aksi/aksi_tambah_buku.php" method="post" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Judul Buku</label>
                <input type="text" name="judul_buku" required
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Pengarang</label>
                    <input type="text" name="pengarang" required class="w-full p-2 border border-gray-300 rounded-md">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Penerbit</label>
                    <input type="text" name="penerbit" required class="w-full p-2 border border-gray-300 rounded-md">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tahun Terbit</label>
                    <input type="date" name="tahun_terbit" min="1900" max="2099" placeholder="YYYY" required
                        class="w-full p-2 border border-gray-300 rounded-md">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Stok</label>
                    <input type="number" name="stok" required class="w-full p-2 border border-gray-300 rounded-md">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Cover Buku</label>
                <input type="file" name="cover" accept="image/*" required
                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700">
            </div>

            <button type="submit" name="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition font-bold">Simpan
                Buku</button>
        </form>
    </div>
</body>

</html>