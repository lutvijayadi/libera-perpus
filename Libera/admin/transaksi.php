<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <title>libera transaksi</title>
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
        <h2 class="font-bold text-2xl text-gray-800">Transaksi</h2>
        <br>
        <div class="mt-8 w-full overflow-hidden rounded-lg shadow-sm border border-gray-200">
            <table class="w-full text-left bg-white">
                <thead class="bg-gray-100 border-b border-gray-200 text-gray-600 uppercase text-sm">
                    <tr>
                        <th class="p-4 border ">ID Transaksi</th>
                        <th class="p-4 border ">Nama Anggota</th>
                        <th class="p-4 border ">Judul Buku</th>
                        <th class="p-4 border ">Tanggal Pinjam</th>
                        <th class="p-4 border ">Tanggal Kembali</th>
                        <th class="p-4 border ">Status</th>
                        <th class="p-4 border ">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                     <?php
                      include '../config/koneksi.php';
    
                      $query = "SELECT * FROM transaksi";
                      $result = mysqli_query($koneksi, $query);
                      
                      if (!$result) {
                            die("Query gagal: " . mysqli_error($koneksi));
                      }
    
                      while ($row = mysqli_fetch_assoc($result)) {
                            echo "<td?>";
                            echo "<td class='p-4 border'>" . $row['id'] . "</td>";
                            echo "<td class='p-4 border'>" . $row['nama'] . "</td>";
                            echo "<td class='p-4 border'>" . $row['judul_buku'] . "</td>";
                            echo "<td class='p-4 border'>" . $row['tanggal_pinjam'] . "</td>";
                            echo "<td class='p-4 border'>" . $row['tanggal_kembali'] . "</td>";
                            echo "<td class='p-4 border'>" . $row['status'] . "</td>";
                            echo "<td class='p-4 text-center'>
                                <a href='edit_transaksi.php?id=" . $row['id'] . "' class='text-blue-600 hover:underline'>edit</a> |
                                <a href='../aksi/aksi_hapus_transaksi.php?id=" . $row['id'] . "' class='text-red-600 hover:underline' onclick=\"return confirm('yakin ingin menghapus data ini?')\">hapus</a>
                              </td>";
                            echo "</tr>";
                      }
    
                      mysqli_close($koneksi);
                      ?>
                </tbody>
            </table>
        </div>
    </section>
    <script>
        feather.replace()
    </script>
</body>

</html>