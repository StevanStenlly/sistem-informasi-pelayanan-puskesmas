<?php
session_name("SCREENING_SESSION");
session_start();
include "../../koneksi.php";
if ($_SESSION['role'] !== 'screening' || empty($_SESSION['screening_nip'])) {
  echo "<script> window.location = '../login/login-petugas.php' </script>";
  exit();
}

function tgl_indo($tanggal)
{
  $bulan = [
    1 => 'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  ];
  $tgl = explode('-', $tanggal);
  return $tgl[2] . ' ' . $bulan[(int)$tgl[1]] . ' ' . $tgl[0];
}

$start_date = $_GET['start_date'] ?? date('Y-m-d');
$end_date = $_GET['end_date'] ?? date('Y-m-d');

$screening_nip = $_SESSION['screening_nip'];
$nama_petugas = $_SESSION['screening_nama'] ?? 'Petugas Screening';

$query = "SELECT rm.*, p.nama_pasien, p.nik_pasien, p.jk_pasien, rm.sakit, rm.status_screening, rm.tgl_pemeriksaan
          FROM rekam_medis rm
          JOIN pasien p ON rm.nik_pasien = p.nik_pasien
          WHERE DATE(rm.tgl_pemeriksaan) BETWEEN '$start_date' AND '$end_date'
          ORDER BY rm.tgl_pemeriksaan DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Laporan Riwayat Screening</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 12px;
    }

    .kop {
      text-align: center;
      margin-bottom: 20px;
    }

    .kop img {
      width: 100%;
      height: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th,
    td {
      border: 1px solid black;
      padding: 6px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
      text-align: center;
    }

    .ttd {
      margin-top: 60px;
      width: 300px;
      float: right;
      text-align: center;
    }

    @media print {
      .no-print {
        display: none;
      }
    }
  </style>
</head>

<body onload="window.print()">

  <div class="kop">
    <img src="../../img/pkm.png" alt="Kop Surat">
    <h4>Laporan Riwayat Screening Pasien</h4>
    <p><strong>Periode:</strong> <?= tgl_indo($start_date) ?> s.d. <?= tgl_indo($end_date) ?></p>
  </div>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Nama Pasien</th>
        <th>NIK</th>
        <th>L/P</th>
        <th>Keluhan</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      while ($data = mysqli_fetch_assoc($result)) {
        $tgl = tgl_indo($data['tgl_pemeriksaan']);
        $status = ($data['status_screening'] === 'Sudah Diperiksa') ? 'Sudah Diperiksa' : 'Belum Diperiksa';
      ?>
        <tr>
          <td align="center"><?= $no++ ?></td>
          <td><?= $tgl ?></td>
          <td><?= htmlspecialchars($data['nama_pasien']) ?></td>
          <td><?= $data['nik_pasien'] ?></td>
          <td align="center"><?= $data['jk_pasien'] ?></td>
          <td><?= htmlspecialchars($data['sakit']) ?></td>
          <td align="center"><?= $status ?></td>
        </tr>
      <?php }
      if ($no === 1) { ?>
        <tr>
          <td colspan="7" align="center" style="padding: 10px;">Tidak ada data screening pada periode tersebut.</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <br><br><br>
  <div style="text-align: right;">
    <p>Petugas Screening,</p>
    <br><br>
    <p><u><?= htmlspecialchars($nama_petugas) ?></u></p>
    <p style="font-size: 11pt;">Tanggal Cetak: <?= date('d-m-Y') ?></p>
  </div>

</body>

</html>