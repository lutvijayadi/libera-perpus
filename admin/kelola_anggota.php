<?php
include '../config/koneksi.php';

// ambil data dari users (hanya siswa)
$query = "SELECT * FROM users WHERE level='siswa' ORDER BY nama ASC";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query error: " . mysqli_error($koneksi));
}

$keyword = isset($_GET['cari']) ? $_GET['cari'] : "";

$keyword = isset($_GET['cari']) ? trim($_GET['cari']) : "";

if (!empty($keyword)) {

    $keyword = mysqli_real_escape_string($koneksi, $keyword);

    $query = "SELECT * FROM users 
              WHERE level='siswa' 
              AND (
                  nama LIKE '%$keyword%' 
                  OR username LIKE '%$keyword%' 
                  OR status LIKE '%$keyword%'
              )
              ORDER BY nama ASC";

} else {

    $query = "SELECT * FROM users 
              WHERE level='siswa' 
              ORDER BY nama ASC";
}

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100..900&display=swap" rel="stylesheet">
    <title>Libera Kelola Anggota</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-[#B0FFFA]">
    <?php include 'partials/sidebar.php'; ?>

    <main class="ml-60 p-4 min-h-screen">
        <section>
            <div class="bg-gradient-to-r from-blue-600 to-blue-500 p-8 rounded-2xl shadow-lg text-white mb-8">
            
                <h2 class="text-3xl font-bold mb-2">Kelola Anggota</h2>
                <p class="text-blue-100 opacity-90">
                    Manajemen data siswa dan keanggotaan perpustakaan Libera.
                </p>
            </div>

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">DAFTAR ANGGOTA</h2>
                <form method="GET" class="mb-4 flex items-center gap-2">
                    <input type="text" name="cari" placeholder="Cari nama, username, atau status..."
                        value="<?php echo isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : ''; ?>"
                        class="px-4 py-2 rounded-lg border border-gray-300 text-sm w-64">

                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm">
                        Cari
                    </button>


                    <a href="kelola_anggota.php"
                        class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 text-sm">
                        Reset
                    </a>
                </form>
                <div class="flex gap-2">
                    <a href="../resources/cetak/cetak_anggota.php?cari=<?php echo isset($_GET['cari']) ? urlencode($_GET['cari']) : ''; ?>"
                        target="_blank"
                        class="flex items-center gap-2 px-5 py-2.5 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition-all shadow-md hover:shadow-lg text-sm">
                        <img src="../resources/img/cetak.png" class="w-5 h-5 opacity-80">
                        Cetak
                    </a>
                    <!-- Tombol Tambah -->
                    <a href="../admin/tambah_anggota.php"
                        class="flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-all shadow-md hover:shadow-lg text-sm">
                        <img src="../resources/img/tambah.png" class="w-5 h-5 opacity-80">
                        Tambah Anggota
                    </a>
                </div>
            </div>

            <div class="mt-4 relative overflow-hidden bg-blue-300 shadow-md rounded-2xl border border-blue-200">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs uppercase bg-blue-600 text-white border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 font-bold text-center">No</th>
                            <th class="px-6 py-4 font-bold">Nama Lengkap</th>
                            <th class="px-6 py-4 font-bold">Kelas</th>
                            <th class="px-6 py-4 font-bold text-center">Status</th>
                            <th class="px-6 py-4 font-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        <?php
                        $no = 1;

                        if (mysqli_num_rows($result) > 0) {
                            while ($data = mysqli_fetch_assoc($result)) {

                                $status_class = ($data['status'] == 'aktif')
                                    ? 'bg-green-100 text-green-600'
                                    : 'bg-red-100 text-red-600';
                                ?>
                                <tr class="hover:bg-blue-50/50 transition-colors border-b border-gray-100">
                                    <td class="px-6 py-4 text-center text-gray-400"><?php echo $no++; ?></td>

                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-700"><?php echo $data['nama']; ?></div>
                                    </td>

                                    <td class="px-6 py-4 text-gray-600">
                                        <?php echo $data['kelas']; ?>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <span class="px-3 py-1 rounded-full text-[10px] font-bold <?php echo $status_class; ?>">
                                            <?php echo $data['status']; ?>
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="edit_anggota.php?id=<?php echo $data['id_users']; ?>"
                                                class="p-2 text-blue-600 hover:bg-blue-100 rounded-lg">
                                                <img src="../resources/img/edit.png" class="w-5 h-5 opacity-80">
                                            </a>

                                            <a href="../aksi/aksi_hapus_anggota.php?id=<?php echo $data['id_users']; ?>"
                                                onclick="return confirm('Yakin ingin menghapus user ini?')"
                                                class="p-2 text-red-500 hover:bg-red-50 rounded-lg">
                                                <img src="../resources/img/hapus2.png" class="w-5 h-5 opacity-80">
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php if (mysqli_num_rows($result) == 0): ?>
                <tr>
                    <td colspan="5" class="text-center py-10 text-gray-500 font-semibold">
                        Data tidak ditemukan
                    </td>
                </tr>
            <?php endif; ?>
        </section>
    </main>

    <script>
        feather.replace();
    </script>
</body>

</html>