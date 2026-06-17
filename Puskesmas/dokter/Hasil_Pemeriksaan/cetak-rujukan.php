<?php
include "../../koneksi.php";

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

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "
SELECT sr.*, rm.tgl_pemeriksaan, p.nama_pasien, p.jk_pasien, p.tgl_lahir_pasien, p.alamat_pasien
FROM surat_rujukan sr
JOIN rekam_medis rm ON sr.id_rm = rm.id_rm
JOIN pasien p ON rm.nik_pasien = p.nik_pasien
WHERE sr.id_rujukan = '$id'
"));

$nama_pengirim = $data['nama_pengirim'] ?? 'Admin';
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Cetak Surat Rujukan</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 12px;
      margin: 30px;
    }

    .kop {
      text-align: center;
      margin-bottom: 20px;
    }

    .kop img {
      width: 100%;
      height: auto;
    }

    .judul {
      text-align: center;
      font-weight: bold;
      font-size: 16px;
      margin-top: 10px;
      margin-bottom: 20px;
      text-transform: uppercase;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    td {
      vertical-align: top;
      padding: 4px;
    }

    td.label {
      width: 30%;
    }

    td.colon {
      width: 2%;
      text-align: center;
    }

    td.value {
      width: 68%;
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
  </div>

  <div class="judul">SURAT RUJUKAN PASIEN</div>

  <table>
    <tr>
      <td class="label">No. Rujukan</td>
      <td class="colon">:</td>
      <td class="value"><?= $data['no_rujukan'] ?></td>
    </tr>
    <tr>
      <td class="label">Tanggal Rujukan</td>
      <td class="colon">:</td>
      <td class="value"><?= tgl_indo($data['tanggal_rujukan']) ?></td>
    </tr>
  </table>

  <h4>Data Pasien</h4>
  <table>
    <tr>
      <td class="label">Nama</td>
      <td class="colon">:</td>
      <td class="value"><?= htmlspecialchars($data['nama_pasien']) ?></td>
    </tr>
    <tr>
      <td class="label">Jenis Kelamin</td>
      <td class="colon">:</td>
      <td class="value"><?= $data['jk_pasien'] ?></td>
    </tr>
    <tr>
      <td class="label">Tanggal Lahir</td>
      <td class="colon">:</td>
      <td class="value"><?= tgl_indo($data['tgl_lahir_pasien']) ?></td>
    </tr>
    <tr>
      <td class="label">Alamat</td>
      <td class="colon">:</td>
      <td class="value"><?= htmlspecialchars($data['alamat_pasien']) ?></td>
    </tr>
  </table>

  <h4>Diagnosa</h4>
  <table>
    <tr>
      <td class="label">Kode ICD-10</td>
      <td class="colon">:</td>
      <td class="value"><?= $data['ICD_10'] ?></td>
    </tr>
    <tr>
      <td class="label">Nama Diagnosa</td>
      <td class="colon">:</td>
      <td class="value"><?= htmlspecialchars($data['diagnosa']) ?></td>
    </tr>
  </table>

  <h4>Alasan Rujukan</h4>
  <table>
    <tr>
      <td class="label">Alasan</td>
      <td class="colon">:</td>
      <td class="value"><?= nl2br(htmlspecialchars($data['alasan_rujukan'])) ?></td>
    </tr>
  </table>

  <h4>Fasilitas Tujuan</h4>
  <table>
    <tr>
      <td class="label">Fasilitas</td>
      <td class="colon">:</td>
      <td class="value"><?= htmlspecialchars($data['fasilitas_tujuan']) ?></td>
    </tr>
    <tr>
      <td class="label">Poli Tujuan</td>
      <td class="colon">:</td>
      <td class="value"><?= htmlspecialchars($data['poli_tujuan']) ?></td>
    </tr>
  </table>

  <br><br>
  <div class="ttd">
    <p>Dokter/Admin Pengirim</p>
    <br><br><br>
    <p><u><?= htmlspecialchars($nama_pengirim) ?></u></p>
    <p style="font-size: 11px;">Tanggal Cetak: <?= date('d-m-Y') ?></p>
  </div>

</body>

</html>