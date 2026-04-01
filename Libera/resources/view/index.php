<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <title>Libera</title>
</head>

<body class="bg-black">

    <div class="container mx-auto px-4">

        <!-- NAVBAR -->
        <nav class="flex justify-between items-center py-4">

            <!-- LOGO -->
            <img src="../img/logo.png" class="h-10">

            <!-- MENU DESKTOP -->
            <ul class="hidden lg:flex gap-8 text-white font-bold text-sm">
                <li><a href="dashboard.php">Halaman Utama</a></li>
                <li><a href="manage_users.php">Layanan</a></li>
                <li><a href="settings.php">contak</a></li>
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
        <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-40">

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

    <script>
        feather.replace();

        function toggleMenu() {
            const menu = document.getElementById("mobileMenu");
            menu.classList.toggle("hidden");
        }
    </script>

</body>

</html>