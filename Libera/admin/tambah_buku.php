<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Feather -->
    <script src="https://unpkg.com/feather-icons"></script>

    <title>Tambah Buku</title>
</head>

<body class=" bg-[#B0FFFA] font-poppins min-h-screen flex items-center justify-center">

    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-lg overflow-hidden grid md:grid-cols-2">

        <!-- LEFT (INFO PANEL) -->
        <div class="bg-gradient-to-br from-blue-600 to-blue-500 text-white p-6 flex flex-col justify-between">
            <div>
                <h2 class="text-xl font-semibold mb-2">Tambah Buku Baru</h2>
                <p class="text-sm opacity-90">
                    Tambahkan koleksi buku baru ke dalam sistem perpustakaan dengan mudah.
                </p>
            </div>

            <div class="mt-6">
                <i data-feather="book-open" class="w-16 h-16 opacity-80"></i>
            </div>
        </div>

        <!-- RIGHT (FORM) -->
        <div class="p-6">

            <form action="../aksi/aksi_tambah_buku.php" method="post" enctype="multipart/form-data" class="space-y-4">

                <!-- JUDUL -->
                <div>
                    <label class="text-sm text-gray-600 flex items-center gap-2 mb-1">
                        <i data-feather="book"></i> Judul Buku
                    </label>
                    <input type="text" name="judul_buku" required
                        class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none">
                </div>

                <!-- PENGARANG & PENERBIT -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-sm text-gray-600 flex items-center gap-2 mb-1">
                            <i data-feather="user"></i> Pengarang
                        </label>
                        <input type="text" name="pengarang" required
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                    </div>

                    <div>
                        <label class="text-sm text-gray-600 flex items-center gap-2 mb-1">
                            <i data-feather="edit-3"></i> Penerbit
                        </label>
                        <input type="text" name="penerbit" required
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                    </div>
                </div>

                <!-- TAHUN & STOK -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-sm text-gray-600 flex items-center gap-2 mb-1">
                            <i data-feather="calendar"></i> Tahun
                        </label>
                        <input type="number" name="tahun_terbit" min="1900" max="2099" required
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                    </div>

                    <div>
                        <label class="text-sm text-gray-600 flex items-center gap-2 mb-1">
                            <i data-feather="layers"></i> Stok
                        </label>
                        <input type="number" name="stok" required
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                    </div>
                </div>

                <!-- COVER -->
                <div>
                    <label class="text-sm text-gray-600 flex items-center gap-2 mb-2">
                        <i data-feather="image"></i> Cover Buku
                    </label>

                    <input type="file" name="cover" accept="image/*" required
                        onchange="previewImage(event)"
                        class="w-full text-sm text-gray-500">

                    <!-- PREVIEW -->
                    <img id="preview" class="mt-3 w-24 h-32 object-cover rounded shadow hidden">
                </div>

                <!-- BUTTON -->
                <button type="submit" name="submit"
                    class="w-full bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 transition flex items-center justify-center gap-2 shadow">
                    <i data-feather="save"></i>
                    Simpan Buku
                </button>

            </form>

        </div>

    </div>

    <script>
        feather.replace();

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