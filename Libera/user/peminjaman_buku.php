<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&family=Poppins:wght@100..900&display=swap" rel="stylesheet">
    <title>libera data buku</title>
</head>
<body>
     <div class="container">
        <div class="fixed left-0 top-0 h-screen w-60 p-6 flex flex-col gap-8 bg-[#fff] shadow-lg z-10">
            <nav>
                <img src="../resources/img/logo.png" alt="Logo">
            </nav>
            <nav class="mt-10 bg-white gap-3 p-2 rounded-lg flex items-center hover:bg-gray-100">
                <i data-feather="home" class="w-5 h-5"></i>
                <a class="text-black" href="../user/dashboard_user.php">Dashboard</a>
            </nav>
            <nav class="bg-white gap-3 p-2 rounded-lg flex items-center hover:bg-gray-100">
                <i data-feather="book" class="w-5 h-5"></i>
                <a class="text-black" href="../user/peminjaman_buku.php">kelola data buku</a>
            </nav>
            <nav>
                <i data-feather="book" class="w-5 h-5"></i>
                <a class="text-black" href="../user/pengembalian_buku.php">pengembalian buku</a>
            </nav>
            <nav class="mt-auto bg-white gap-3 p-2 rounded-lg flex items-center">
                <i data-feather="settings" class="w-5 h-5"></i>
            </nav>
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
        <h2 class="font-bold text-2xl text-gray-800">Data Buku</h2>
        <br>
        <div class="flex items-center gap-3 bg-blue-500 text-white p-2 px-4 rounded-lg hover:bg-blue-700 cursor-pointer w-fit justify-center transition shadow-md">
            <i data-feather="plus" class="w-5 h-5"></i>
            <a href="tambah_buku.php">tambah buku</a>
        </div>

        <div class="mt-8 w-full overflow-hidden rounded-lg shadow-sm border border-gray-200">
            <table class="w-full text-left bg-white">
                <thead class="bg-gray-100 border-b border-gray-200 text-gray-600 uppercase text-sm">
                    <tr>
                        <th class="p-4">id</th>
                        <th class="p-4">cover</th>
                        <th class="p-4">judul buku</th>
                        <th class="p-4">pengarang</th>
                        <th class="p-4">penerbit</th>
                        <th class="p-4">tahun terbit</th>
                        <th class="p-4">stok</th>
                        <th class="p-4 text-center">aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php
                    include '../config/koneksi.php';

                    $query = "SELECT * FROM buku";
                    $result = mysqli_query($koneksi, $query);
                    
                    if (!$result) {
                        die("Query error: " . mysqli_error($koneksi));
                    }

                    $no = 1;

                    while ($data = mysqli_fetch_assoc($result)) {
                        echo "<tr class='hover:bg-gray-50 transition'>";
                        echo "<td class='p-4 text-center'>" . $no++ . "</td>";
                        echo "<td class='p-4'><img src='../uploads/" . $data['cover'] . "' alt='Cover Buku' class='w-16 h-20 object-cover rounded'></td>";
                        echo "<td class='p-4 font-medium'>" . $data['judul_buku'] . "</td>";
                        echo "<td class='p-4'>" . $data['pengarang'] . "</td>";
                        echo "<td class='p-4'>" . $data['penerbit'] . "</td>";
                        echo "<td class='p-4'>" . $data['tahun_terbit'] . "</td>";
                        echo "<td class='p-4'>" . $data['stok'] . "</td>";
                        echo "<td class='p-4 text-center'>
                                <a href='edit_buku.php?judul_buku=" . $data['judul_buku'] . "' class='text-blue-600 hover:underline'>edit</a> |
                                <a href='../aksi/aksi_hapus_buku.php?judul_buku=" . $data['judul_buku'] . "' class='text-red-600 hover:underline' onclick=\"return confirm('yakin ingin menghapus data ini?')\">hapus</a>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>