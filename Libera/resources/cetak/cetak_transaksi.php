<?php
include '../../config/koneksi.php';

$keyword = isset($_GET['cari']) ? trim($_GET['cari']) : "";

if (!empty($keyword)) {
    $keyword = mysqli_real_escape_string($koneksi, $keyword);

    $query = "SELECT * FROM transaksi 
              WHERE 
                nama LIKE '%$keyword%' OR
                judul_buku LIKE '%$keyword%' OR
                status LIKE '%$keyword%' OR
                tanggal_pinjam LIKE '%$keyword%' OR
                tanggal_kembali LIKE '%$keyword%'
              ORDER BY id_transaksi DESC";
} else {
    $query = "SELECT * FROM transaksi ORDER BY id_transaksi DESC";
}

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cetak Transaksi</title>
    <style>
        body {
            font-family: Arial;
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background: #eee;
        }
    </style>
</head>

<body onload="window.print()">

    <h2>Data Transaksi Perpustakaan</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Buku</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id_transaksi']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['judul_buku']; ?></td>
                    <td><?php echo date('d-m-Y', strtotime($row['tanggal_pinjam'])); ?></td>
                    <td><?php echo date('d-m-Y', strtotime($row['tanggal_kembali'])); ?></td>
                    <td><?php echo $row['status']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>