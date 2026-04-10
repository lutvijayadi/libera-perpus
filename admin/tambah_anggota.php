<?php

include '../config/koneksi.php';

if (isset($_POST['tambah'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        echo "Username sudah digunakan!";
        exit;
    }
}
?>
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

    <title>Tambah Anggota</title>
</head>

<body class="bg-[#B0FFFA] font-poppins min-h-screen flex items-center justify-center">

    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-lg overflow-hidden grid md:grid-cols-2">

        <!-- LEFT PANEL -->
        <div class="bg-gradient-to-br from-blue-600 to-blue-500 text-white p-6 flex flex-col justify-between">
            <div>
                <h2 class="text-xl font-semibold mb-2">Tambah Anggota</h2>
                <p class="text-sm opacity-90">
                    Tambahkan anggota baru ke sistem perpustakaan dengan mudah dan cepat.
                </p>
            </div>

            <div class="mt-6">
                <i data-feather="users" class="w-16 h-16 opacity-80"></i>
            </div>
        </div>

        <!-- RIGHT FORM -->
        <div class="p-6">
            <form action="../aksi/aksi_tambah_anggota.php" method="post" class="space-y-4">
                <div>
                    <label class="text-sm mb-1">Nama</label>
                    <input type="text" name="nama" required class="w-full p-2 border rounded-lg">
                </div>
                <div>
                    <label class="text-sm mb-1">Kelas</label>
                    <input type="text" name="kelas" required class="w-full p-2 border rounded-lg">
                </div>
                <div>
                    <label class="text-sm mb-1">Username</label>
                    <input type="text" name="username" required class="w-full p-2 border rounded-lg">
                </div>

                <div>
                    <label class="text-sm mb-1">Password</label>
                    <input type="password" name="password" required class="w-full p-2 border rounded-lg">
                </div>
                <div>
                    <label class="text-sm mb-1">Status</label>
                    <select name="status" class="w-full p-2 border rounded-lg">
                        <option value="aktif">Aktif</option>
                        <option value="non_aktif">Non Aktif</option>
                    </select>
                </div>
                <button type="submit" name="tambah"
                    class="mt-8 w-full bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 transition flex items-center justify-center gap-2 shadow">
                    <i data-feather="user-plus"></i>
                    Tambah Anggota
                </button>
            </form>


        </div>

    </div>

    <script>
        feather.replace();
    </script>

</body>

</html>