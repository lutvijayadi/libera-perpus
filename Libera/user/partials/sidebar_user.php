<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-full transition-transform -translate-x-full sm:translate-x-0 " aria-label="Sidebar">
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
            <nav class="bg-white gap-3 p-2 rounded-lg flex items-center hover:bg-gray-100">
                <i data-feather="book-open" class="w-5 h-5"></i>
                <a class="text-black" href="../user/pengembalian_buku.php">pengembalian buku</a>
            </nav>
            <nav class="mt-auto bg-white gap-3 p-2 rounded-lg flex items-center">
                <i data-feather="settings" class="w-5 h-5"></i>
            </nav>
        </div>
    </div>
</aside>