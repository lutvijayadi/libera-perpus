<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/src/output.css">
    <title>Registrasi Libera</title>
</head>

<body class="min-h-screen flex items-center pl-10 bg-no-repeat"
    style="background-image: url('../resources/img/cover%20book.png'); background-position: center; background-size: cover;">
    <main>
        <form action="../aksi/aksi_registrasi.php" method="post"
            class="ml-60 bg-white p-8 rounded-xl shadow-2xl w-full max-w-sm">
            <h2 class="text-2xl font-bold mb-4 text-center">Registrasi</h2>

            <div class="mb-4">
                <label for="nama" class="block text-gray-700 mb-2 font-medium">Nama Lengkap</label>
                <input type="text" id="nama" name="nama"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 outline-none"
                    required>
            </div>

            <div class="mb-4">
                <label for="username" class="block text-gray-700 mb-2 font-medium">Username</label>
                <input type="text" id="username" name="username"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 outline-none"
                    required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 mb-2 font-medium">Password</label>
                <input type="password" id="password" name="password"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 outline-none"
                    required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2 font-medium">Kelas</label>
                <input type="text" name="kelas"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 outline-none"
                    required>
            </div>

            <button type="submit" name="daftar"
                class="w-full py-2 rounded-xl bg-blue-500 text-white font-bold transition transform hover:scale-105 hover:bg-blue-600 shadow-md">
                Daftar Sekarang
            </button>
        </form>
    </main>
</body>

</html>