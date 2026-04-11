<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../public/src/output.css">

    <title>Tambah Anggota - Libera</title>
</head>

<body class="bg-[#B0FFFA] font-poppins min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-lg overflow-hidden grid md:grid-cols-2">

        <div class="bg-linear-to-r from-[#2563eb] to-[#3b82f6] text-white p-6 flex flex-col justify-between">
            <div>

                <h2 class="text-xl font-semibold mb-2">Tambah Anggota</h2>
                <p class="text-sm opacity-90">
                    Tambahkan anggota baru ke sistem perpustakaan dengan mudah dan cepat.
                </p>
            </div>

            <div class="mt-6">
                <img src="../resources/img/anggota.png" class="w-16 h-16 opacity-80 brightness-0 invert">
            </div>
        </div>

        <div class="p-6">
            <form action="../aksi/aksi_tambah_anggota.php" method="post" class="space-y-4">
                <div>
                    <label class="text-sm text-gray-600 flex items-center gap-2 mb-1">
                        <img src="../resources/img/profil.png" class="w-4 h-4 opacity-70"> Nama Lengkap
                    </label>
                    <input type="text" name="nama" required 
                        class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none transition-all">
                </div>

                <div>
                    <label class="text-sm text-gray-600 flex items-center gap-2 mb-1">
                        <img src="../resources/img/penerbit.png" class="w-4 h-4 opacity-70"> Kelas
                    </label>
                    <input type="text" name="kelas" required 
                        class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none transition-all">
                </div>

                <div>
                    <label class="text-sm text-gray-600 flex items-center gap-2 mb-1">
                        <img src="../resources/img/anggota.png" class="w-4 h-4 opacity-70"> Username
                    </label>
                    <input type="text" name="username" required 
                        class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none transition-all">
                </div>

                <div>
                    <label class="text-sm text-gray-600 flex items-center gap-2 mb-1">
                        <img src="../resources/img/hash.png" class="w-4 h-4 opacity-70"> Password
                    </label>
                    <input type="password" name="password" required 
                        class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none transition-all">
                </div>

                <div>
                    <label class="text-sm text-gray-600 flex items-center gap-2 mb-1">
                        <img src="../resources/img/status.png" class="w-4 h-4 opacity-70"> Status
                    </label>
                    <select name="status" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none cursor-pointer">
                        <option value="aktif">Aktif</option>
                        <option value="non_aktif">Non Aktif</option>
                    </select>
                </div>

                <div class="flex gap-3 pt-4">
                    <a href="kelola_anggota.php" 
                        class="flex-1 border-2 border-blue-300 text-blue-600 py-3 rounded-xl hover:bg-gray-50 transition flex items-center justify-center font-medium">
                        Batal
                    </a>
                    <button type="submit" name="tambah"
                        class="flex-2 bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 transition flex items-center justify-center gap-2 shadow-lg font-semibold group">
                        Tambah Anggota
                    </button>
                </div>
            </form>
        </div>

    </div>

</body>

</html>