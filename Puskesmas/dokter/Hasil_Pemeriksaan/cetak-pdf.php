<?php
include '../../koneksi.php';

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

$id_rm = $_GET['id_rm'];
$query = "SELECT rm.*, d.nama_dokter, p.* FROM rekam_medis rm
          JOIN dokter d ON rm.nip_dokter = d.nip_dokter
          JOIN pasien p ON rm.nik_pasien = p.nik_pasien
          WHERE rm.id_rm = '$id_rm'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

$resep_result = mysqli_query($conn, "SELECT ro.*, o.nama_obat, o.dosis_obat, o.satuan FROM resep_obat ro 
                                     JOIN obat o ON ro.kode_obat = o.kode_obat 
                                     WHERE ro.id_rm = '$id_rm'");
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Cetak Rekam Medis</title>
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

    h3,
    h4 {
      text-align: center;
      margin: 10px 0;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    td,
    th {
      padding: 6px;
      vertical-align: top;
    }

    .label {
      width: 30%;
    }

    .colon {
      width: 3%;
      text-align: center;
    }

    .value {
      width: 67%;
    }

    .bordered th,
    .bordered td {
      border: 1px solid black;
      text-align: left;
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

  <h3>REKAM MEDIS PASIEN</h3>
  <h4>Nomor RM: <?= htmlspecialchars($data['rm']) ?></h4>

  <table>
    <tr>
      <td class="label">Nama</td>
      <td class="colon">:</td>
      <td class="value"><?= htmlspecialchars($data['nama_pasien']) ?></td>
    </tr>
    <tr>
      <td>Jenis Kelamin</td>
      <td>:</td>
      <td><?= $data['jk_pasien'] ?></td>
    </tr>
    <tr>
      <td>Tempat, Tgl Lahir</td>
      <td>:</td>
      <td><?= $data['tempat_lahir_pasien'] . ', ' . tgl_indo($data['tgl_lahir_pasien']) ?></td>
    </tr>
    <tr>
      <td>Umur</td>
      <td>:</td>
      <td><?= $data['umur'] ?></td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td><?= htmlspecialchars($data['alamat_pasien']) ?></td>
    </tr>
    <tr>
      <td>Nomor Jaminan</td>
      <td>:</td>
      <td><?= $data['bpjs'] ?></td>
    </tr>
    <tr>
      <td>Riwayat Alergi</td>
      <td>:</td>
      <td><?= $data['riwayat_alergi_pasien'] ?></td>
    </tr>
    <tr>
      <td>Agama</td>
      <td>:</td>
      <td><?= $data['agama_pasien'] ?></td>
    </tr>
    <tr>
      <td>No. HP</td>
      <td>:</td>
      <td><?= $data['no_hp_pasien'] ?></td>
    </tr>
  </table>

  <h4>Hasil Pemeriksaan</h4>
  <table class="bordered">
    <tr>
      <th>Anamnesis (S)</th>
      <th>Pemeriksaan Fisik (O)</th>
      <th>Diagnosis (A)</th>
      <th>Keterangan (P)</th>
    </tr>
    <tr>
      <td>
        Sakit: <?= $data['sakit'] ?><br>
        Nyeri Telan: <?= $data['nyeri_telan'] ?><br>
        Demam: <?= $data['demam'] ?><br>
        Batuk: <?= $data['batuk'] ?><br>
        Pilek: <?= $data['pilek'] ?>
      </td>
      <td>
        TD: <?= $data['tekanan_darah'] ?><br>
        N: <?= $data['nadi'] ?><br>
        RR: <?= $data['siklus_nafas'] ?><br>
        T: <?= $data['suhu_badan'] ?><br>
        TB: <?= $data['tinggi_badan'] ?><br>
        BB: <?= $data['berat_badan'] ?><br>
        LP: <?= $data['lingkar_perut'] ?>
      </td>
      <td>
        ICD-10: <?= $data['ICD_10'] ?><br>
        Nama Penyakit: <?= $data['nama_penyakit'] ?>
      </td>
      <td><?= nl2br(htmlspecialchars($data['keterangan_hasil'])) ?></td>
    </tr>
  </table>

  <h4>Resep Obat</h4>
  <table class="bordered">
    <tr>
      <th style="width:5%;">No</th>
      <th>Nama Obat</th>
      <th>Dosis</th>
      <th style="width:10%;">Jumlah</th>
    </tr>
    <?php
    $no = 1;
    while ($r = mysqli_fetch_assoc($resep_result)) {
      echo '<tr>
              <td style="text-align: center;">' . $no++ . '</td>
              <td>' . htmlspecialchars($r['nama_obat'] . ' ' . $r['dosis_obat'] . ' ' . $r['satuan']) . '</td>
              <td>' . htmlspecialchars($r['dosis']) . '</td>
              <td style="text-align: center;">' . $r['jumlah'] . '</td>
            </tr>';
    }
    if ($no === 1) {
      echo '<tr><td colspan="4" style="text-align:center;">Tidak ada resep obat.</td></tr>';
    }
    ?>
  </table>

  <br><br>
  <div class="ttd">
    <p>Dokter Pemeriksa</p>
    <br><br><br>
    <p><u><?= htmlspecialchars($data['nama_dokter']) ?></u></p>
    <p>Tanggal: <?= date('d-m-Y') ?></p>
  </div>

</body>

</html>