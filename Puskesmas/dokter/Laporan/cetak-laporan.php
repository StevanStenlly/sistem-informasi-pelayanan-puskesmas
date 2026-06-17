<?php
session_name("DOKTER_SESSION");
session_start();
include '../../koneksi.php';
if ($_SESSION['role'] !== 'dokter' || empty($_SESSION['dokter_nip'])) {
  echo "<script> window.location = '../login/login-dokter.php' </script>";
  exit();
}

$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-01');
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d');
$nip = $_SESSION['dokter_nip'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Laporan Rekam Medis</title>
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
    <h4>Laporan Rekam Medis</h4>
    <p><strong>Periode:</strong> <?= date('d-m-Y', strtotime($start_date)) ?> s.d <?= date('d-m-Y', strtotime($end_date)) ?></p>
  </div>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Pasien</th>
        <th>Umur</th>
        <th>Keluhan</th>
        <th>Hasil Pemeriksaan</th>
        <th>ICD 10</th>
        <th>Nama Penyakit</th>
        <th>Dokter</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $query = "
        SELECT rm.*, p.nama_pasien, rm.umur, rm.sakit, rm.keterangan_hasil,
               rm.ICD_10, rm.nama_penyakit, d.nama_dokter
        FROM rekam_medis rm
        JOIN pasien p ON rm.nik_pasien = p.nik_pasien
        JOIN dokter d ON rm.nip_dokter = d.nip_dokter
        WHERE rm.nip_dokter = '$nip'
        AND DATE(rm.tgl_pemeriksaan) BETWEEN '$start_date' AND '$end_date'
        ORDER BY rm.tgl_pemeriksaan DESC
      ";
      $hasil = mysqli_query($conn, $query);
      $no = 1;
      $nama_dokter = '-';
      while ($row = mysqli_fetch_assoc($hasil)) :
        $nama_dokter = $row['nama_dokter'];
      ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($row['nama_pasien']) ?></td>
          <td><?= $row['umur'] ?></td>
          <td><?= htmlspecialchars($row['sakit']) ?></td>
          <td><?= htmlspecialchars($row['keterangan_hasil']) ?></td>
          <td><?= $row['ICD_10'] ?></td>
          <td><?= htmlspecialchars($row['nama_penyakit']) ?></td>
          <td><?= htmlspecialchars($row['nama_dokter']) ?></td>
        </tr>
      <?php endwhile; ?>

      <?php if ($no === 1) : ?>
        <tr>
          <td colspan="8" style="text-align: center;">Tidak ada data rekam medis pada periode ini.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

  <br><br><br>
  <div style="text-align: right;">
    <p>Dokter Pemeriksa,</p>
    <br><br>
    <p><u><?= htmlspecialchars($nama_dokter) ?></u></p>
    <p style="font-size: 11pt;">Tanggal Cetak: <?= date('d-m-Y') ?></p>
  </div>

</body>

</html>