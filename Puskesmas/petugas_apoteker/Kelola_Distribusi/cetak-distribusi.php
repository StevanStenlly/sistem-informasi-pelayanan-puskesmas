<?php
session_name("APOTEKER_SESSION");
session_start();
include '../../koneksi.php';

if ($_SESSION['role'] !== 'apoteker' || empty($_SESSION['apoteker_nip'])) {
    exit('Akses tidak sah.');
}

$from = $_GET['from_date'] ?? '';
$to = $_GET['to_date'] ?? '';
$whereClause = '';
if (!empty($from) && !empty($to)) {
    $from = mysqli_real_escape_string($conn, $from);
    $to = mysqli_real_escape_string($conn, $to);
    $whereClause = "WHERE d.tgl_distribusi BETWEEN '$from' AND '$to'";
} else {
    $today = date('Y-m-d');
    $whereClause = "WHERE DATE(d.tgl_distribusi) = '$today'";
}

$query = "
    SELECT rm.id_rm, p.nama_pasien, pt.nama_petugas AS nama_apoteker, d.tgl_distribusi, d.waktu_distribusi,
        GROUP_CONCAT(CONCAT(o.nama_obat, ' (', r.jumlah, ')') SEPARATOR ', ') AS daftar_obat,
        SUM(r.jumlah) AS total_jumlah
    FROM distribusi_obat d
    JOIN resep_obat r ON d.id_resep = r.id_resep
    JOIN obat o ON r.kode_obat = o.kode_obat
    JOIN rekam_medis rm ON r.id_rm = rm.id_rm
    JOIN pasien p ON rm.nik_pasien = p.nik_pasien
    JOIN petugas pt ON d.nip_petugas = pt.nip_petugas
    $whereClause
    GROUP BY rm.id_rm, d.tgl_distribusi, d.waktu_distribusi
    ORDER BY d.tgl_distribusi DESC, d.waktu_distribusi DESC
";

$result = mysqli_query($conn, $query);
$rows = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Distribusi Obat</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }

        h4 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            font-size: 11pt;
        }
    </style>
</head>

<body onload="window.print()">
    <div style="text-align: center;">
        <img src="../../img/pkm.png" width="886" height="182" alt="Kop Surat">
    </div>

    <h4>Laporan Riwayat Distribusi Obat</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Pasien</th>
                <th>Daftar Obat</th>
                <th>Jumlah</th>
                <th>Tanggal Distribusi</th>
                <th>Waktu</th>
                <th>Apoteker</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($rows as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['nama_pasien']) ?></td>
                    <td><?= htmlspecialchars($row['daftar_obat']) ?></td>
                    <td class="text-center"><?= $row['total_jumlah'] ?></td>
                    <td><?= date('d-m-Y', strtotime($row['tgl_distribusi'])) ?></td>
                    <td><?= date('H:i', strtotime($row['waktu_distribusi'])) ?></td>
                    <td><?= htmlspecialchars($row['nama_apoteker']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br><br><br>
    <div style="text-align: right;">
        <p>Petugas Apoteker</p>
        <br><br>
        <p><u><?= $_SESSION['apoteker_nama'] ?? '________________' ?></u></p>
        <p style="font-size: 11pt;">Tanggal Cetak: <?= date('d-m-Y') ?></p>
    </div>
</body>

</html>