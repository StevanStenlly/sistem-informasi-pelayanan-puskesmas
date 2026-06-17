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
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include '../link.php'; ?>
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
      <h1>Data Pasien</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Data Pasien</li>
        </ol>
      </nav>
    </div>

    <div class="card mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-bordered table-striped hidden-until-ready" id="dataTable" width="100%" cellspacing="0">
            <thead class="table-primary">
              <tr>
                <th>No</th>
                <th>Foto Pasien</th>
                <th>Nomor Rekam Medis</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $id_ru = $_SESSION['ruang_id'];
              $ambilsemuapasien = mysqli_query($conn, "SELECT * FROM rekam_medis a
                LEFT JOIN pasien d ON a.nik_pasien = d.nik_pasien 
                WHERE id_ruang = '$id_ru' AND status_dokter = 'Sudah Diperiksa' 
                GROUP BY d.nik_pasien ORDER BY rm");
              $i = 1;
              while ($data = mysqli_fetch_array($ambilsemuapasien)) {
                $foto_pasien = $data['foto_pasien'];
                $nama_pasien = $data['nama_pasien'];
                $jk_pasien = $data['jk_pasien'];
                $agama_pasien = $data['agama_pasien'];
                $idps = $data['nik_pasien'];
                $status_pernikahan_pasien = $data['status_pernikahan_pasien'];
                $alamat_pasien = $data['alamat_pasien'];
                $no_hp_pasien = $data['no_hp_pasien'];
                $password_pasien = $data['password_pasien'];
                $ttl_pasien = $data['ttl_pasien'];
                $pekerjaan_pasien = $data['pekerjaan_pasien'];
                $riwayat_alergi_pasien = $data['riwayat_alergi_pasien'];
                $rm = $data['rm'];
              ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><img src="../../adm/Kelola_Pasien/img/<?php echo $foto_pasien; ?>" alt="<?php echo $foto_pasien; ?>" height="80" width="80"></td>
                  <td>K-<?= $rm; ?></td>
                  <td><?= $nama_pasien; ?></td>
                  <td><?= $idps; ?></td>
                  <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                      <a type="button" class="btn btn-primary btn-sm" href="detail-pasien.php?nik_pasien=<?php echo $data["nik_pasien"]; ?>"><i class="bi bi-eye-fill"></i></a>
                      <a type="button" class="btn btn-success btn-sm" href="tabel-rm.php?nik_pasien=<?php echo $data["nik_pasien"]; ?>"><i class="bi bi-archive-fill"></i></a>
                    </div>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>

  <?php include '../footer.php'; ?>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/js/main.js"></script>

  <!-- DataTable Initialization -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const tableEl = document.querySelector("#dataTable");
      tableEl.classList.remove("hidden-until-ready");
      tableEl.style.visibility = "visible";

      const dataTable = new simpleDatatables.DataTable(tableEl, {
        labels: {
          noRows: "Tidak ada data pasien.",
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