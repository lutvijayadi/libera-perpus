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
    <title></title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            margin: 40px;
        }

        .kop {
            text-align: center;
            line-height: 1.5;
        }

        .kop h2, .kop h3 {
            margin: 0;
        }

        .line {
            border-top: 3px solid black;
            margin: 10px 0 20px 0;
        }

        .judul {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        .ttd {
            margin-top: 50px;
            width: 100%;
        }

        .ttd-kanan {
            float: right;
            text-align: center;
        }

        .clear {
            clear: both;
        }
    </style>
</head>

<body onload="window.print()">

    <!-- KOP SURAT -->
    <div class="kop">
        <h2>PERPUSTAKAAN SEKOLAH</h2>
        <h3>SMK AL- MADANI GARUT</h3>
        <p>Jl. Raya Samarang No.2332, Desa/Kecamatan Samarang, Kabupaten Garut, Jawa Barat, Kode Pos 44161</p>
    </div>

    <div class="line"></div>

    <!-- JUDUL -->
    <div class="judul">
        <h3><u>LAPORAN DATA TRANSAKSI</u></h3>
    </div>

    <!-- TABEL -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Buku</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td style="text-align:left;"><?php echo $row['nama']; ?></td>
                    <td style="text-align:left;"><?php echo $row['judul_buku']; ?></td>
                    <td><?php echo date('d-m-Y', strtotime($row['tanggal_pinjam'])); ?></td>
                    <td><?php echo date('d-m-Y', strtotime($row['tanggal_kembali'])); ?></td>
                    <td><?php echo $row['status']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- TANDA TANGAN -->
    <div class="ttd">
        <div class="ttd-kanan">
            <p>Garut, <?php echo date("d M Y"); ?></p>
            <p>Petugas Perpustakaan</p>

            <br><br><br>

            <p><u>_____________________</u></p>
        </div>
    </div>

    <div class="clear"></div>

</body>
</html>