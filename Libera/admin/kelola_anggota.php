<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&family=Poppins:wght@100..900&display=swap" rel="stylesheet">
    <title>libera kelola anggota</title>
</head>
<body>
    <div class="container">
        <div class="fixed left-0 top-0 h-screen w-60 p-6 flex flex-col gap-8 bg-[#fff] shadow-lg z-10">
            <nav>
                <img src="../resources/img/logo.png" alt="Logo">
            </nav>
            <nav class="mt-10 bg-white gap-3 p-2 rounded-lg flex items-center hover:bg-gray-100">
                <i data-feather="home" class="w-5 h-5"></i>
                <a class="text-black" href="../admin/dashboard.php">Dashboard</a>
            </nav>
            <nav class="bg-white gap-3 p-2 rounded-lg flex items-center hover:bg-gray-100">
                <i data-feather="users" class="w-5 h-5"></i>
                <a class="text-black" href="../admin/kelola_anggota.php">kelola anggota</a>
            </nav>
            <nav class="bg-white gap-3 p-2 rounded-lg flex items-center hover:bg-gray-100">
                <i data-feather="book" class="w-5 h-5"></i>
                <a class="text-black" href="../admin/kelola_data_buku.php">kelola data buku</a>
            </nav>
            <nav class="bg-white gap-3 p-2 rounded-lg flex items-center hover:bg-gray-100">
                <i data-feather="file-text" class="w-5 h-5"></i>
                <a class="text-black" href="../admin/transaksi.php">transaksi</a>
            </nav>
            <nav class="mt-auto bg-white gap-3 p-2 rounded-lg flex items-center">
                <i data-feather="settings" class="w-5 h-5"></i>
            </nav>
        </div>
    </div>
</div>
<section>   
        <div class="ml-60 p-4 justify-between flex items-center bg-[#fFF] shadow-lg">
            <h1 class="font-bold uppercase tracking-wide"></h1>
            <div class="flex items-center gap-4">
                <span class="text-sm font-medium">Admin Libera</span>
                <img src="../resources/img/hapidd.png" alt="Admin" class="w-8 h-8 rounded-full border">
            </div>
        </div>
    </section>
    <section class="ml-60 p-8">
        <h2 class="font-bold text-2xl text-gray-800">Kelola Anggota</h2>
        <br>
        <div>
            <div class="flex items-center gap-3 bg-blue-500 text-white p-2 px-4 rounded-lg hover:bg-blue-700 cursor-pointer w-fit justify-center transition shadow-md">
                <i data-feather="plus" class="w-5 h-5"></i>
                <a href="../admin/tambah_anggota.php">tambah anggota</a>
            </div>
        </div>
        <div class="mt-8 w-full overflow-hidden rounded-lg shadow-sm border border-gray-200">
            <table class="w-full table-auto border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-4 border ">ID Anggota</th>
                        <th class="p-4 border">Nama</th>
                        <th class="p-4 border">kelas</th>
                        <th class="p-4 border">status</th>
                        <th class="p-4 border">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                   <?php
                    include '../config/koneksi.php';

                    $query = "SELECT * FROM anggota";
                    $result = mysqli_query($koneksi, $query);
                    
                    if (!$result) {
                        die("Query error: " . mysqli_error($koneksi));
                    }

                    $no = 1;

                    while ($data = mysqli_fetch_assoc($result)) {
                        echo "<tr class='hover:bg-gray-50 transition'>";
                        echo "<td class='p-2 text-center border'>" . $no++ . "</td>";
                        echo "<td class='p-2 font-medium border'>" . $data['nama'] . "</td>";
                        echo "<td class='p-2 font-medium border'>" . $data['kelas'] . "</td>";
                        echo "<td class='p-2 border'>" . $data['status'] . "</td>";
                        echo "<td class='p-2 text-center'>
                                <a href='edit_anggota.php?nama=" . $data['nama'] . "' class='text-blue-600 hover:underline BORDER'>edit</a> |
                                <a href='../aksi/aksi_hapus_anggota.php?nama=" . $data['nama'] . "' class='text-red-600 hover:underline' border onclick=\"return confirm('yakin ingin menghapus data ini?')\">hapus</a>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>


</body>
</html>