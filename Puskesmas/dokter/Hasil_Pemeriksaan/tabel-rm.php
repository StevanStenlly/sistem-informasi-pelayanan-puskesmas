<?php
session_name("DOKTER_SESSION");
session_start();
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

// Validasi Login Dokter
if ($_SESSION['role'] !== 'dokter' || empty($_SESSION['dokter_nip'])) {
  echo "<script> window.location = '../login/login-dokter.php' </script>";
  exit();
}

$detail = $_GET["nik_pasien"];
$id_rm_aktif = isset($_GET["id_rm"]) ? $_GET["id_rm"] : null;
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <?php include '../link.php'; ?>
  <title>Rekam Medis - Resep Obat</title>
  <style>
    .hidden-until-ready {
      visibility: hidden;
    }
  </style>
</head>

<body>
  <?php include '../header.php';
  include '../siderbar.php'; ?>

  <main id="main" class="main">
    <div class="pagetitle">
      <?php
      $ambilsemuahasil = mysqli_query($conn, "SELECT * FROM pasien WHERE nik_pasien = '$detail'");
      $data = mysqli_fetch_array($ambilsemuahasil);
      $nama_pasien = $data['nama_pasien'];
      ?>
      <h1>Rekam Medis <?= $nama_pasien ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="tabel-hp.php">Kelola Hasil Pemeriksaan</a></li>
          <li class="breadcrumb-item"><a href="detail-hp.php?id_rm=<?= $id_rm_aktif ?>">Detail Hasil Pemeriksaan</a></li>
          <li class="breadcrumb-item active">Rekam Medis <?= $nama_pasien ?></li>
        </ol>
      </nav>
    </div>

    <section class="section profile">
      <div class="row">
        <div class="col-xl">
          <div class="card">
            <div class="card-body pt-3">
              <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped hidden-until-ready" id="dataTable" width="100%" cellspacing="0">
                  <thead class="table-primary text-center">
                    <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Nama Dokter</th>
                      <th>ICD 10</th>
                      <th>Nama Penyakit</th>
                      <th>Keterangan</th>
                      <th>Resep Obat</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $id_ru = $_SESSION['ruang_id'];
                    $ambilsemuahasil = mysqli_query($conn, "
                      SELECT a.*, d.nama_pasien, e.nama_dokter 
                      FROM rekam_medis a 
                      LEFT JOIN ruang c ON a.id_ruang = c.id_ruang 
                      LEFT JOIN pasien d ON a.nik_pasien = d.nik_pasien 
                      LEFT JOIN dokter e ON a.nip_dokter = e.nip_dokter 
                      WHERE d.nik_pasien = '$detail' 
                      AND a.id_ruang = '$id_ru' 
                      AND status_dokter = 'Sudah Diperiksa'
                      ORDER BY a.id_rm DESC
                    ");

                    $i = 1;
                    while ($data = mysqli_fetch_array($ambilsemuahasil)) {
                      $id_rm = $data['id_rm'];
                      $nama_dokter = $data['nama_dokter'];
                      $tgl_pemeriksaan = $data['tgl_pemeriksaan'];
                      $ICD_10 = $data['ICD_10'];
                      $nama_penyakit = $data['nama_penyakit'];
                      $keterangan_hasil = $data['keterangan_hasil'];

                      // Ambil resep obat
                      $queryResep = "
                        SELECT o.nama_obat, r.dosis, r.jumlah 
                        FROM resep_obat r 
                        JOIN obat o ON r.kode_obat = o.kode_obat 
                        WHERE r.id_rm = '$id_rm'
                      ";
                      $resultResep = mysqli_query($conn, $queryResep);
                      $resep_obat = '';
                      while ($resep = mysqli_fetch_assoc($resultResep)) {
                        $resep_obat .= $resep['nama_obat'] . " (" . $resep['dosis'] . ", " . $resep['jumlah'] . ")<br>";
                      }
                      if (empty($resep_obat)) {
                        $resep_obat = '<span class="text-muted">Tidak ada resep</span>';
                      }
                    ?>
                      <tr>
                        <td class="text-center"><?= $i++; ?></td>
                        <td class="text-center"><?= date('d-m-Y', strtotime($tgl_pemeriksaan)); ?></td>
                        <td><?= htmlspecialchars($nama_dokter ?? '') ?></td>
                        <td class="text-center"><?= htmlspecialchars($ICD_10); ?></td>
                        <td><?= htmlspecialchars($nama_penyakit); ?></td>
                        <td><?= htmlspecialchars($keterangan_hasil); ?></td>
                        <td><?= $resep_obat; ?></td>
                        <td class="text-center">
                          <a class="btn btn-primary btn-sm" href="detail-rm.php?id_rm=<?= $id_rm; ?>&id_sumber=<?= $id_rm_aktif; ?>">
                            <i class="bi bi-eye-fill"></i>
                          </a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include '../footer.php'; ?>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/js/main.js"></script>

  <!-- Table Initialization -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const tableEl = document.querySelector("#dataTable");
      tableEl.classList.remove("hidden-until-ready");
      tableEl.style.visibility = "visible";

      const dataTable = new simpleDatatables.DataTable(tableEl, {
        labels: {
          noRows: "Tidak ada data rekam medis.",
          placeholder: "Cari...",
          perPage: "Data per halaman",
          noResults: "Tidak ditemukan hasil yang cocok",
          info: "Menampilkan {start} sampai {end} dari total {rows} data"
        }
      });
    });
  </script>

</body>

</html>