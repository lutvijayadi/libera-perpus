<?php
include '../config/koneksi.php';

session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}
$where = [];


if (!empty($_GET['search'])) {
    $search = mysqli_real_escape_string($koneksi, $_GET['search']);
    $where[] = "judul_buku LIKE '%$search%'";
}

if (!empty($_GET['penerbit'])) {
    $penerbit = mysqli_real_escape_string($koneksi, $_GET['penerbit']);
    $where[] = "penerbit = '$penerbit'";
}


if (!empty($_GET['status'])) {
    if ($_GET['status'] == 'tersedia') {
        $where[] = "stok > 0";
    } elseif ($_GET['status'] == 'habis') {
        $where[] = "stok = 0";
    }
}

// gabungkan query
$where_sql = "";
if (count($where) > 0) {
    $where_sql = "WHERE " . implode(" AND ", $where);
}

$query_buku = mysqli_query($koneksi, "
    SELECT * FROM buku
    $where_sql
    ORDER BY id_buku DESC
");
$username = $_SESSION['username'];

$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
$user = mysqli_fetch_assoc($query);

// total buku
$total_buku = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM buku"))['total'];

// total user
$total_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM users"))['total'];

// total transaksi
$total_pinjam = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM transaksi"))['total'];

$where = [];

if (!empty($_GET['search'])) {
    $search = mysqli_real_escape_string($koneksi, $_GET['search']);
    $where[] = "judul_buku LIKE '%$search%'";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body class="bg-gray-100 font-poppins">

    <?php include 'partials/sidebar_user.php'; ?>

    <main class="p-6">

        <!-- HEADER -->
        <section>
            <div class="bg-gradient-to-r from-blue-600 to-blue-500 p-6 rounded-2xl shadow-lg text-white">
                <h2 class="text-2xl font-semibold">
                    Halo, <?php echo $user['nama'] ?? 'User'; ?>
                </h2>
                <p class="text-sm opacity-90 mt-1">
                    Selamat datang, silakan pilih buku yang ingin dipinjam
                </p>
            </div>
        </section>

        <!-- STATISTIK -->
        <section class="mt-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- TOTAL USER -->
                <div
                    class="bg-white p-5 rounded-2xl shadow-md hover:shadow-xl transition flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total User</p>
                        <h2 class="text-3xl font-bold text-blue-600 mt-2"><?= $total_user ?></h2>
                    </div>
                    <img src="../resources/img/anggota.png" class="w-12 h-12">
                </div>

                <!-- TOTAL BUKU -->
                <div
                    class="bg-white p-5 rounded-2xl shadow-md hover:shadow-xl transition flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Buku</p>
                        <h2 class="text-3xl font-bold text-green-600 mt-2"><?= $total_buku ?></h2>
                    </div>
                    <img src="../resources/img/buku.png" class="w-12 h-12">
                </div>

                <!-- TOTAL PINJAM -->
                <div
                    class="bg-white p-5 rounded-2xl shadow-md hover:shadow-xl transition flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Peminjaman</p>
                        <h2 class="text-3xl font-bold text-yellow-500 mt-2"><?= $total_pinjam ?></h2>
                    </div>
                    <img src="../resources/img/baca_buku.png" class="w-12 h-12">
                </div>

            </div>
        </section>

        <!-- SEARCH -->
        <section class="mt-4">
            <form method="GET" class="bg-white p-4 rounded-xl shadow flex flex-wrap gap-3 items-center">

                <!-- SEARCH -->
                <input type="text" name="search" placeholder="Cari buku..." value="<?= $_GET['search'] ?? '' ?>"
                    class="px-3 py-2 rounded-lg border text-sm flex-1">

                <!-- Filter Penerbit -->
                <select name="penerbit" class="px-3 py-2 rounded-lg border text-sm">
                    <option value="">Semua Penerbit</option>
                    <?php
                    $penerbit_query = mysqli_query($koneksi, "SELECT DISTINCT penerbit FROM buku");
                    while ($p = mysqli_fetch_assoc($penerbit_query)) {
                        $selected = (isset($_GET['penerbit']) && $_GET['penerbit'] == $p['penerbit']) ? 'selected' : '';
                        echo "<option value='{$p['penerbit']}' $selected>{$p['penerbit']}</option>";
                    }
                    ?>
                </select>

                <!-- Filter Status -->
                <select name="status" class="px-3 py-2 rounded-lg border text-sm">
                    <option value="">Semua Status</option>
                    <option value="tersedia" <?= (isset($_GET['status']) && $_GET['status'] == 'tersedia') ? 'selected' : '' ?>>Tersedia</option>
                    <option value="habis" <?= (isset($_GET['status']) && $_GET['status'] == 'habis') ? 'selected' : '' ?>>
                        Habis</option>
                </select>

                <!-- Tombol Search -->
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700">
                    Cari
                </button>

                <!-- Reset -->
                <a href="dashboard_user.php" class="px-4 py-2 bg-gray-300 rounded-lg text-sm hover:bg-gray-400">
                    Reset
                </a>

            </form>
        </section>

        <!-- DATA BUKU -->
        <section class="mt-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Daftar Buku</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                <?php while ($buku = mysqli_fetch_assoc($query_buku)) { ?>
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition overflow-hidden group">

                        <!-- COVER -->
                        <div class="h-48 bg-gray-100 overflow-hidden">
                            <?php if (!empty($buku['cover'])) { ?>
                                <img src="../uploads/<?php echo $buku['cover']; ?>"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            <?php } else { ?>
                                <div class="flex items-center justify-center h-full text-gray-400 text-sm">
                                    No Cover
                                </div>
                            <?php } ?>
                        </div>

                        <!-- CONTENT -->
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-800 truncate">
                                <?php echo $buku['judul_buku']; ?>
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                <?php echo $buku['pengarang']; ?>
                            </p>

                            <div class="flex justify-between items-center mt-3">
                                <span class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded-full">
                                    <?php echo $buku['penerbit']; ?>
                                </span>

                                <span class="text-xs font-semibold 
                                <?php echo ($buku['stok'] > 0) ? 'text-green-600' : 'text-red-500'; ?>">
                                    <?php echo ($buku['stok'] > 0) ? 'Tersedia' : 'Habis'; ?>
                                </span>
                            </div>

                            <!-- BUTTON -->
                            <div class="mt-4">
                                <a href="pinjam_buku.php?id=<?php echo $buku['id_buku']; ?>"
                                    class="block text-center text-sm bg-blue-600 text-white py-2 rounded-xl hover:bg-blue-700 hover:scale-105 transition">
                                    Pinjam
                                </a>
                            </div>
                        </div>

                    </div>
                <?php } ?>

            </div>
        </section>

    </main>

</body>

</html>