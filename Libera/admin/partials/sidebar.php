<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Deteksi halaman aktif untuk styling otomatis
$current_page = basename($_SERVER['PHP_SELF']);
?>

<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-60 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-6 py-8 overflow-y-auto bg-blue-600 border-r border-blue-500/30 shadow-2xl flex flex-col">
        
        <div class="flex items-center justify-center mb-10 px-2">
            <img src="../resources/img/logo.png" alt="Logo Libera" class="h-10 w-auto filter brightness-0 invert">
        </div>

        <nav class="flex-1 space-y-2 font-medium">
            <p class="text-xs font-semibold text-blue-200 uppercase tracking-widest mb-4 px-3">Main Menu</p>
            
            <a href="../admin/dashboard.php" 
               class="flex items-center p-3 text-sm rounded-xl transition-all duration-200 group <?php echo ($current_page == 'dashboard.php') ? 'bg-white text-blue-600 shadow-lg scale-105' : 'text-white hover:bg-blue-500/50 hover:translate-x-1'; ?>">
                <i data-feather="grid" class="w-5 h-5 mr-3 <?php echo ($current_page == 'dashboard.php') ? 'text-blue-600' : 'text-blue-100 group-hover:text-white'; ?>"></i>
                <span>Dashboard</span>
            </a>

            <a href="../admin/kelola_anggota.php" 
               class="flex items-center p-3 text-sm rounded-xl transition-all duration-200 group <?php echo ($current_page == 'kelola_anggota.php') ? 'bg-white text-blue-600 shadow-lg scale-105' : 'text-white hover:bg-blue-500/50 hover:translate-x-1'; ?>">
                <i data-feather="users" class="w-5 h-5 mr-3 <?php echo ($current_page == 'kelola_anggota.php') ? 'text-blue-600' : 'text-blue-100 group-hover:text-white'; ?>"></i>
                <span>Kelola Anggota</span>
            </a>

            <a href="../admin/kelola_data_buku.php" 
               class="flex items-center p-3 text-sm rounded-xl transition-all duration-200 group <?php echo ($current_page == 'kelola_data_buku.php') ? 'bg-white text-blue-600 shadow-lg scale-105' : 'text-white hover:bg-blue-500/50 hover:translate-x-1'; ?>">
                <i data-feather="book-open" class="w-5 h-5 mr-3 <?php echo ($current_page == 'kelola_data_buku.php') ? 'text-blue-600' : 'text-blue-100 group-hover:text-white'; ?>"></i>
                <span>Data Buku</span>
            </a>

            <a href="../admin/transaksi.php" 
               class="flex items-center p-3 text-sm rounded-xl transition-all duration-200 group <?php echo ($current_page == 'transaksi.php') ? 'bg-white text-blue-600 shadow-lg scale-105' : 'text-white hover:bg-blue-500/50 hover:translate-x-1'; ?>">
                <i data-feather="repeat" class="w-5 h-5 mr-3 <?php echo ($current_page == 'transaksi.php') ? 'text-blue-600' : 'text-blue-100 group-hover:text-white'; ?>"></i>
                <span>Transaksi</span>
            </a>
        </nav>

        <div class="mt-auto pt-6 border-t border-blue-400/30">
            <div class="flex items-center p-3 rounded-2xl bg-blue-700/40 mb-4">
                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center text-white border border-white/30">
                    <i data-feather="user" class="w-5 h-5"></i>
                </div>
                <div class="ml-3 overflow-hidden">
                    <p class="text-sm font-bold text-white truncate"><?php echo $_SESSION['username'] ?? 'Admin'; ?></p>
                    <p class="text-xs text-blue-200 capitalize">Administrator</p>
                </div>
            </div>
            
            <a href="../logout.php" class="flex items-center p-3 text-sm font-medium text-red-200 rounded-xl hover:bg-red-500/20 hover:text-red-100 transition-all">
                <i data-feather="log-out" class="w-5 h-5 mr-3"></i>
                <span>Keluar</span>
            </a>
        </div>
    </div>
</aside>