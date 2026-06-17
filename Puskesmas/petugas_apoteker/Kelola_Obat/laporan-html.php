<?php
session_name("APOTEKER_SESSION");
session_start();
include "../../koneksi.php";

$filter = $_GET['filterLaporan'] ?? 'semua';

$query = "SELECT * FROM obat";
$result = mysqli_query($conn, $query);

$rows = [];
$tanggal_sekarang = new DateTime();

while ($row = mysqli_fetch_assoc($result)) {
    $tgl_kadaluarsa = DateTime::createFromFormat('Y-m-d', $row['tgl_kadaluarsa']);
    $kadaluarsa = ($tgl_kadaluarsa && $tgl_kadaluarsa < $tanggal_sekarang);
    $stok_menipis = ($row['stok_obat'] <= $row['minimum_stok']);

    $tampilkan = false;
    if ($filter === 'kadaluarsa' && $kadaluarsa) {
        $tampilkan = true;
    } elseif ($filter === 'stok_tipis' && $stok_menipis) {
        $tampilkan = true;
    } elseif ($filter === 'semua' && !$kadaluarsa && !$stok_menipis) {
        $tampilkan = true;
    }

    if ($tampilkan) $rows[] = $row;
}

$judul = [
    'kadaluarsa' => 'Obat Kadaluarsa',
    'stok_tipis' => 'Obat Stok Menipis',
    'semua' => 'Obat Tidak Kadaluarsa & Stok Aman'
][$filter] ?? 'Laporan Obat';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }

        h2,
        h4 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        td,
        th {
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
    <h4>Laporan Stok Obat - <?= $judul ?></h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Obat</th>
                <th>Nama Obat</th>
                <th>Dosis</th>
                <th>Satuan</th>
                <th>Stok</th>
                <th>Min. Stok</th>
                <th>Kadaluarsa</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($rows as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['kode_obat'] ?></td>
                    <td><?= $row['nama_obat'] ?></td>
                    <td><?= $row['dosis_obat'] ?></td>
                    <td><?= $row['satuan'] ?></td>
                    <td><?= $row['stok_obat'] ?></td>
                    <td><?= $row['minimum_stok'] ?></td>
                    <td><?= $row['tgl_kadaluarsa'] ?></td>
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