<?php
include '../../config/koneksi.php';

$keyword = isset($_GET['cari']) ? trim($_GET['cari']) : "";

if (!empty($keyword)) {

    $keyword = mysqli_real_escape_string($koneksi, $keyword);
    $kata = explode(" ", $keyword);

    $conditions = [];
    foreach ($kata as $k) {
        $conditions[] = "(nama LIKE '%$k%' OR username LIKE '%$k%')";
    }

    $where = implode(" AND ", $conditions);

    $query = "SELECT * FROM users 
              WHERE level='siswa' 
              AND ($where)
              ORDER BY nama ASC";

} else {
    $query = "SELECT * FROM users 
              WHERE level='siswa' 
              ORDER BY nama ASC";
}

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cetak Anggota</title>
    <style>
        body {
            font-family: Arial;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background: #eee;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body onload="window.print()">

    <h2>Data Anggota Perpustakaan</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($data = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['nama']; ?></td>
                <td><?php echo $data['username']; ?></td>
                <td><?php echo $data['status']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>