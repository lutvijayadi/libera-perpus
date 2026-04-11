<?php
include '../../config/koneksi.php';

// ambil data dari database
$total_buku = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM buku"));
$total_user = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM users"));
$total_transaksi = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM transaksi"));
$total_notif = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM notif"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/src/output.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <title>Libera</title>
</head>

<body class="bg-black">

    <div class="container mx-auto px-4">

        <!-- NAVBAR -->
        <nav class="flex justify-between items-center py-4">

            <!-- LOGO -->
            <img src="../img/logo.png" class="h-10">

            <ul class="hidden lg:flex gap-8 text-white font-bold text-sm items-center">

                <li><a href="#beranda">Beranda</a></li>
                <li><a href="#tentang">Tentang Kami</a></li>
                <li><a href="#layanan">Layanan</a></li>
                <li><a href="#kontak">Kontak</a></li>

                <!-- DROPDOWN AKTIVITAS -->
                <li class="relative group">
                    <button class="flex items-center gap-1">
                        Aktivitas
                        <i data-feather="chevron-down" class="w-4 h-4"></i>
                    </button>

                    <!-- DROPDOWN MENU -->
                    <div
                        class="absolute hidden group-hover:block bg-white text-black mt-2 rounded-lg shadow-lg w-48 z-50">

                        <a href="berita.php" class="block px-4 py-2 hover:bg-gray-100">Berita</a>
                        <a href="testimoni.php" class="block px-4 py-2 hover:bg-gray-100">Testimoni</a>
                        <a href="agenda.php" class="block px-4 py-2 hover:bg-gray-100">Agenda</a>
                        <a href="pengumuman.php" class="block px-4 py-2 hover:bg-gray-100">Pengumuman</a>

                    </div>
                </li>

                <li><a href="../aksi/t.php">MeChat</a></li>

            </ul>

            <!-- BUTTON + HAMBURGER -->
            <div class="flex items-center gap-3">

                <a href="../../auth/login.php"
                    class="hidden lg:block text-white border px-5 py-2 rounded-full text-sm hover:bg-white hover:text-black transition">
                    Log in
                </a>

                <!-- HAMBURGER -->
                <button onclick="toggleMenu()" class="lg:hidden text-white">
                    <i data-feather="menu"></i>
                </button>

            </div>

        </nav>

        <!-- MOBILE MENU -->
        <div id="mobileMenu" class="hidden bg-black border-t border-gray-700">
            <ul class="hidden lg:flex gap-8 text-white font-bold text-sm">
                <li><a href="dashboard.php">Halaman Utama</a></li>
                <li><a href="manage_users.php">Layanan</a></li>
                <li><a href="settings.php">contak</a></li>
                <li><a href="../aksi/aksi_logout.php">MeChat</a></li>
            </ul>
        </div>

    </div>

    <!-- HERO SECTION -->
    <section
        class="bg-center bg-no-repeat bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/conference.jpg')] bg-gray-900 bg-blend-multiply">
        <div class="px-4 mx-auto max-w-7xl text-center py-24 lg:py-40">

            <h1 class="mb-6 text-4xl font-bold text-white md:text-5xl lg:text-6xl">
                Perpustakaan Digital Libera
            </h1>

            <p class="mb-8 text-gray-300 md:text-lg lg:text-xl">
                Sistem peminjaman buku modern rasakan kecanggihan
                teknologi <br>memudahkan anak sekolah untuk meminjam
                buku dan lebih efesien.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">


                <a href="#" class="text-white border border-gray-400 hover:bg-gray-800 px-6 py-3 rounded-lg">
                    Pelajari Lebih Lanjut
                </a>

            </div>

        </div>

    </section>
    <!-- LAYANAN TAMBAHAN -->
    <section class="py-20 bg-gray-950 text-white" id="layanan">

        <div class="max-w-6xl mx-auto px-4">

            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold">Layanan Digital Perpustakaan</h2>
                <p class="text-gray-400 text-sm mt-2">
                    Akses berbagai layanan perpustakaan nasional & digital
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">

                <!-- CARD -->
                <a href="#" target="_blank"
                    class="block bg-gray-900 p-5 rounded-xl hover:bg-blue-600 transition transform hover:scale-105 shadow-lg">
                    <h3 class="font-bold text-lg">BintangPusnas Edu</h3>
                    <p class="text-sm text-gray-400 mt-1">Platform edukasi digital</p>
                </a>

                <a href="https://onesearch.id" target="_blank"
                    class="block bg-gray-900 p-5 rounded-xl hover:bg-blue-600 transition transform hover:scale-105 shadow-lg">
                    <h3 class="font-bold text-lg">OneSearch.id</h3>
                    <p class="text-sm text-gray-400 mt-1">Pencarian koleksi nasional</p>
                </a>

                <a href="#"
                    class="block bg-gray-900 p-5 rounded-xl hover:bg-blue-600 transition transform hover:scale-105 shadow-lg">
                    <h3 class="font-bold text-lg">OPAC Perpusnas</h3>
                    <p class="text-sm text-gray-400 mt-1">Katalog online perpustakaan</p>
                </a>

                <a href="#"
                    class="block bg-gray-900 p-5 rounded-xl hover:bg-blue-600 transition transform hover:scale-105 shadow-lg">
                    <h3 class="font-bold text-lg">iPusnas</h3>
                    <p class="text-sm text-gray-400 mt-1">Aplikasi baca buku digital</p>
                </a>

                <a href="#"
                    class="block bg-gray-900 p-5 rounded-xl hover:bg-blue-600 transition transform hover:scale-105 shadow-lg">
                    <h3 class="font-bold text-lg">Keanggotaan</h3>
                    <p class="text-sm text-gray-400 mt-1">Daftar anggota perpustakaan</p>
                </a>

                <a href="#"
                    class="block bg-gray-900 p-5 rounded-xl hover:bg-blue-600 transition transform hover:scale-105 shadow-lg">
                    <h3 class="font-bold text-lg">e-Resources</h3>
                    <p class="text-sm text-gray-400 mt-1">Akses jurnal & ebook</p>
                </a>

                <a href="#"
                    class="block bg-gray-900 p-5 rounded-xl hover:bg-blue-600 transition transform hover:scale-105 shadow-lg">
                    <h3 class="font-bold text-lg">Video Profil Layanan</h3>
                    <p class="text-sm text-gray-400 mt-1">Informasi layanan berbasis TIK</p>
                </a>

                <a href="#"
                    class="block bg-gray-900 p-5 rounded-xl hover:bg-blue-600 transition transform hover:scale-105 shadow-lg">
                    <h3 class="font-bold text-lg">Agenda Kegiatan</h3>
                    <p class="text-sm text-gray-400 mt-1">Event & kegiatan perpustakaan</p>
                </a>

                <a href="#"
                    class="block bg-gray-900 p-5 rounded-xl hover:bg-blue-600 transition transform hover:scale-105 shadow-lg">
                    <h3 class="font-bold text-lg">Virtual Tour</h3>
                    <p class="text-sm text-gray-400 mt-1">Jelajahi gedung perpustakaan</p>
                </a>

                <a href="#"
                    class="block bg-gray-900 p-5 rounded-xl hover:bg-blue-600 transition transform hover:scale-105 shadow-lg">
                    <h3 class="font-bold text-lg">Layanan Kelembagaan</h3>
                    <p class="text-sm text-gray-400 mt-1">Kerja sama perpustakaan</p>
                </a>

                <a href="#"
                    class="block bg-gray-900 p-5 rounded-xl hover:bg-blue-600 transition transform hover:scale-105 shadow-lg">
                    <h3 class="font-bold text-lg">Data Perpustakaan</h3>
                    <p class="text-sm text-gray-400 mt-1">Data seluruh Indonesia</p>
                </a>

                <a href="#"
                    class="block bg-gray-900 p-5 rounded-xl hover:bg-blue-600 transition transform hover:scale-105 shadow-lg">
                    <h3 class="font-bold text-lg">e-Deposit</h3>
                    <p class="text-sm text-gray-400 mt-1">Arsip digital nasional</p>
                </a>

                <a href="#"
                    class="block bg-gray-900 p-5 rounded-xl hover:bg-blue-600 transition transform hover:scale-105 shadow-lg">
                    <h3 class="font-bold text-lg">JDIH Perpusnas</h3>
                    <p class="text-sm text-gray-400 mt-1">Dokumen hukum perpustakaan</p>
                </a>

                <a href="#"
                    class="block bg-gray-900 p-5 rounded-xl hover:bg-blue-600 transition transform hover:scale-105 shadow-lg">
                    <h3 class="font-bold text-lg">Pengadaan Barang/Jasa</h3>
                    <p class="text-sm text-gray-400 mt-1">Layanan pengadaan</p>
                </a>

                <a href="#"
                    class="block bg-gray-900 p-5 rounded-xl hover:bg-blue-600 transition transform hover:scale-105 shadow-lg">
                    <h3 class="font-bold text-lg">Layanan ISBN</h3>
                    <p class="text-sm text-gray-400 mt-1">Registrasi buku resmi</p>
                </a>

                <a href="#"
                    class="block bg-gray-900 p-5 rounded-xl hover:bg-blue-600 transition transform hover:scale-105 shadow-lg">
                    <h3 class="font-bold text-lg">PPID Perpustakaan</h3>
                    <p class="text-sm text-gray-400 mt-1">Informasi publik</p>
                </a>

            </div>

        </div>

    </section>
    <!-- TENTANG KAMI -->
    <section id="tentang" class="py-20 bg-gray-900 text-white">

        <div class="max-w-6xl mx-auto px-4 grid md:grid-cols-2 gap-10 items-center">

            <!-- TEXT -->
            <div>
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Tentang Libera
                </h2>

                <p class="text-gray-400 mb-4">
                    Libera adalah sistem perpustakaan digital yang dirancang untuk membantu sekolah
                    dalam mengelola peminjaman buku secara modern, cepat, dan efisien.
                </p>

                <p class="text-gray-400">
                    Dengan Libera, siswa dapat meminjam buku secara online, memantau status,
                    dan mendapatkan notifikasi secara real-time.
                </p>
            </div>

            <!-- MAP -->
            <!-- MAP SMK AL-MADANI GARUT -->
            <div class="rounded-xl overflow-hidden shadow-lg">
                <iframe src="https://www.google.com/maps?q=SMK+Al+Madani+Garut&output=embed"
                    class="w-full h-80 border-0" allowfullscreen="" loading="lazy">
                </iframe>
            </div>

        </div>

    </section>
    <script>
        feather.replace();

        function toggleMenu() {
            const menu = document.getElementById("mobileMenu");
            menu.classList.toggle("hidden");
        }
    </script>

</body>

</html>