<?php
session_name("ADMIN_SESSION");
session_start();
include '../../koneksi.php';

if ($_SESSION['role'] !== 'admin' || empty($_SESSION['admin_username'])) {
  exit('Akses tidak sah.');
}

$from = $_GET['from_date'] ?? '';
$to = $_GET['to_date'] ?? '';
$whereClause = '';

if (!empty($from) && !empty($to)) {
  $from = mysqli_real_escape_string($conn, $from);
  $to = mysqli_real_escape_string($conn, $to);
  $whereClause = "WHERE rm.tgl_pemeriksaan BETWEEN '$from' AND '$to'";
} else {
  $today = date('Y-m-d');
  $whereClause = "WHERE DATE(rm.tgl_pemeriksaan) = '$today'";
}

$query = "
    SELECT rm.id_rm, rm.tgl_pemeriksaan, rm.waktu_pemeriksaan, rm.nama_penyakit, rm.keterangan_hasil,
           p.nama_pasien, d.nama_dokter
    FROM rekam_medis rm
    JOIN pasien p ON rm.nik_pasien = p.nik_pasien
    JOIN dokter d ON rm.nip_dokter = d.nip_dokter
    $whereClause
    ORDER BY rm.tgl_pemeriksaan DESC, rm.waktu_pemeriksaan DESC
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
  <title>Laporan Kunjungan Pasien</title>
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

  <h4>Laporan Kunjungan Pasien</h4>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Pasien</th>
        <th>Tanggal</th>
        <th>Waktu</th>
        <th>Penyakit</th>
        <th>Keterangan</th>
        <th>Dokter</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1;
      foreach ($rows as $row): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($row['nama_pasien']) ?></td>
          <td><?= date('d-m-Y', strtotime($row['tgl_pemeriksaan'])) ?></td>
          <td><?= date('H:i', strtotime($row['waktu_pemeriksaan'])) ?></td>
          <td><?= htmlspecialchars($row['nama_penyakit']) ?></td>
          <td><?= htmlspecialchars($row['keterangan_hasil']) ?></td>
          <td><?= htmlspecialchars($row['nama_dokter']) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <br><br><br>
  <div style="text-align: right;">
    <p>Admin</p>
    <br><br>
    <p><u><?= $_SESSION['admin_nama'] ?? '________________' ?></u></p>
    <p style="font-size: 11pt;">Tanggal Cetak: <?= date('d-m-Y') ?></p>
  </div>
</body>

</html>