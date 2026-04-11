<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <link rel="stylesheet" href="../public/src/output.css">

    <title>Tambah Buku</title>
</head>

<body class="bg-[#B0FFFA] font-poppins min-h-screen flex items-center justify-center">

    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-lg overflow-hidden grid md:grid-cols-2">

        <!-- LEFT -->
        <div class="bg-linear-to-r from-[#2563eb] to-[#3b82f6] text-white p-6 flex flex-col justify-between">
            <div>
                <h2 class="text-xl font-semibold mb-2">Tambah Buku Baru</h2>
                <p class="text-sm opacity-90">
                    Tambahkan koleksi buku baru ke dalam sistem perpustakaan dengan mudah.
                </p>
            </div>

            <div class="mt-6">
                <img src="../resources/img/buku.png" class="w-16 h-16 opacity-80">
            </div>
        </div>

        <!-- RIGHT -->
        <div class="p-6">

            <form action="../aksi/aksi_tambah_buku.php" method="post" enctype="multipart/form-data" class="space-y-4">

                <!-- JUDUL -->
                <div>
                    <label class="text-sm text-gray-600 flex items-center gap-2 mb-1">
                        <img src="../resources/img/buku.png" class="w-4 h-4"> Judul Buku
                    </label>
                    <input type="text" name="judul_buku" required
                        class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none">
                </div>

                <!-- PENGARANG & PENERBIT -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-sm text-gray-600 flex items-center gap-2 mb-1">
                            <img src="../resources/img/pengarang.png" class="w-4 h-4"> Pengarang
                        </label>
                        <input type="text" name="pengarang" required
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                    </div>

                    <div>
                        <label class="text-sm text-gray-600 flex items-center gap-2 mb-1">
                            <img src="../resources/img/penerbit.png" class="w-4 h-4"> Penerbit
                        </label>
                        <input type="text" name="penerbit" required
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                    </div>
                </div>

                <!-- TAHUN & KATEGORI & STOK -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-sm text-gray-600 flex items-center gap-2 mb-1">
                            <img src="../resources/img/kalender.png" class="w-4 h-4"> Tahun
                        </label>
                        <input type="number" name="tahun_terbit" min="1900" max="2099" required
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                    </div>

                    <div>
                        <label class="text-sm text-gray-600 flex items-center gap-2 mb-1">
                            <img src="../resources/img/hash.png" class="w-4 h-4"> Kategori
                        </label>

                        <select name="kategori" required
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="pelajaran">Pelajaran</option>
                            <option value="novel">Novel</option>
                            <option value="komik">Komik</option>
                            <option value="filsafat">Filsafat</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600 flex items-center gap-2 mb-1">
                            <img src="../resources/img/stok.png" class="w-4 h-4"> Stok
                        </label>
                        <input type="number" name="stok" required
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                    </div>
                </div>

                <!-- COVER -->
                <div>
                    <label class="text-sm text-gray-600 flex items-center gap-2 mb-2">
                        <img src="../resources/img/img.png" class="w-4 h-4"> Cover Buku
                    </label>

                    <input type="file" name="cover" accept="image/*" required onchange="previewImage(event)"
                        class="w-full text-sm text-gray-500">

                    <!-- PREVIEW -->
                    <img id="preview" class="mt-3 w-24 h-32 object-cover rounded shadow hidden">
                </div>

                <!-- BUTTON -->
                <div class="flex gap-3 mt-6">
                    <a href="kelola_data_buku.php"
                        class="flex-1 border-2 border-blue-300 text-blue-600 py-3 rounded-xl hover:bg-gray-50 transition flex items-center justify-center gap-2 font-medium">
                        Batal
                    </a>
                    <button type="submit" name="submit"
                        class="flex-2 bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 transition shadow-lg flex items-center justify-center gap-2 font-semibold">
                        Simpan Buku
                    </button>
                </div>

            </form>

        </div>

    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');

            if (input.files && input.files[0]) {
                preview.src = URL.createObjectURL(input.files[0]);
                preview.classList.remove('hidden');
            }
        }
    </script>

</body>

</html>