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
    <link rel="stylesheet" href="../public/src/output.css">
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
            <div class="bg-linear-to-r from-[#2563eb] to-[#3b82f6] p-8 rounded-2xl shadow-lg text-white mb-8">

                <h2 class="text-3xl font-bold mb-2">Kelola Anggota</h2>
                <p class="text-blue-100 opacity-90">
                    Manajemen data siswa dan keanggotaan perpustakaan Libera.
                </p>
            </div>

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800 uppercase tracking-wide">Daftar Anggota</h2>

                <div class="flex items-center gap-3">
                    <form method="GET"
                        class="flex items-center gap-2 bg-white p-1.5 pl-4 rounded-xl shadow-sm border border-gray-100">
                        <img src="../public/src/icons/search.png" class="w-4 h-4 opacity-40">

                        <input type="text" name="cari" placeholder="Cari nama, kelas..."
                            value="<?php echo isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : ''; ?>"
                            class="text-sm outline-none w-56 bg-transparent text-gray-700">

                        <button type="submit"
                            class="px-4 py-1.5 bg-blue-600 text-white rounded-lg text-xs font-semibold hover:bg-blue-700 transition-colors">
                            Cari
                        </button>

                        <?php if (isset($_GET['cari']) && $_GET['cari'] != ''): ?>
                            <a href="kelola_anggota.php"
                                class="px-3 py-1.5 bg-gray-100 text-gray-500 rounded-lg text-xs font-semibold hover:bg-gray-200 transition-colors mr-1">
                                Reset
                            </a>
                        <?php endif; ?>
                    </form>

                    <div class="flex gap-2">
                        <a href="../resources/cetak/cetak_anggota.php?cari=<?php echo isset($_GET['cari']) ? urlencode($_GET['cari']) : ''; ?>"
                            target="_blank"
                            class="flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white font-semibold rounded-xl hover:bg-emerald-700 transition-all shadow-sm text-sm">
                            <img src="../resources/img/cetak.png" class="w-4 h-4 brightness-0 invert">
                            Cetak
                        </a>

                        <a href="../admin/tambah_anggota.php"
                            class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-all shadow-md text-sm">
                            <img src="../resources/img/tambah.png" class="w-4 h-4 brightness-0 invert">
                            Tambah Anggota
                        </a>
                    </div>
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
</body>

</html>