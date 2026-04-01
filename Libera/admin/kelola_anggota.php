<?php
include '../config/koneksi.php';

// ambil data dari users (hanya siswa)
$query = "SELECT * FROM users WHERE level='siswa' ORDER BY nama ASC";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query error: " . mysqli_error($koneksi));
}
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
                <a href="../admin/tambah_anggota.php"
                    class="flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-all shadow-md hover:shadow-lg text-sm">
                    <i data-feather="plus" class="w-4 h-4"></i>
                    Tambah Anggota
                </a>
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
                        while ($data = mysqli_fetch_assoc($result)) {
                            // Logika warna badge status agar konsisten
                            $status_class = ($data['status'] == 'aktif') ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600';
                            ?>
                            <tr class="hover:bg-blue-50/50 transition-colors border-b border-gray-100">
                                <td class="px-6 py-4 text-center font-medium text-gray-400">
                                    <?php echo $no++; ?>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-700"><?php echo $data['nama']; ?></div>
                                </td>

                                <td class="px-6 py-4 font-medium text-gray-600">
                                    @<?php echo $data['username']; ?>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="px-3 py-1 rounded-full text-[10px] font-bold uppercase <?php echo $status_class; ?>">
                                        <?php echo $data['status']; ?>
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="edit_user.php?id=<?php echo $data['id_users']; ?>"
                                            class="p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition-all"
                                            title="Edit">
                                            <i data-feather="edit-2" class="w-4 h-4"></i>
                                        </a>

                                        <a href="../aksi/aksi_hapus_user.php?id=<?php echo $data['id_users']; ?>"
                                            onclick="return confirm('Yakin ingin menghapus user ini?')"
                                            class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-all"
                                            title="Hapus">
                                            <i data-feather="trash-2" class="w-4 h-4"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script>
        feather.replace();
    </script>
</body>

</html>