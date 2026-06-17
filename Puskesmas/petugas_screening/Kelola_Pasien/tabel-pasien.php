<?php
session_name("SCREENING_SESSION");
session_start();
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if ($_SESSION['role'] !== 'screening' || empty($_SESSION['screening_nip'])) {
  echo "<script> window.location = '../login/login-petugas.php' </script>";
  exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <?php include '../link.php'; ?>
  <style>
    .hidden-until-ready {
      visibility: hidden;
    }

    .table img {
      object-fit: cover;
      border-radius: 6px;
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

    <section class="section profile">
      <div class="row">
        <div class="col-xl">
          <div class="card">
            <div class="card-body pt-3">
              <div class="tab-content pt-2">
                <div class="table-responsive">
                  <table class="table table-hover table-bordered table-striped hidden-until-ready" id="dataTable">
                    <thead class="table-primary text-center">
                      <tr>
                        <th>No</th>
                        <th>Foto Pasien</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $ambilsemuapasien = mysqli_query($conn, "SELECT * FROM pasien");
                      $i = 1;
                      while ($data = mysqli_fetch_array($ambilsemuapasien)) {
                        $foto_pasien = $data['foto_pasien'];
                        $nama_pasien = $data['nama_pasien'];
                        $idps = $data['nik_pasien'];
                      ?>
                        <tr>
                          <td><?= $i++; ?></td>
                          <td class="text-center">
                            <img src="../../adm/Kelola_Pasien/img/<?= $foto_pasien; ?>" alt="<?= $foto_pasien; ?>" height="60" width="60">
                          </td>
                          <td><?= htmlspecialchars($nama_pasien); ?></td>
                          <td><?= $idps; ?></td>
                          <td class="text-center">
                            <a type="button" class="btn btn-primary btn-sm" href="detail-pasien.php?nik_pasien=<?= $idps; ?>">
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
      </div>
    </section>
  </main>

  <?php include '../footer.php'; ?>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/js/main.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const tableEl = document.querySelector("#dataTable");
      tableEl.classList.remove("hidden-until-ready");
      tableEl.style.visibility = "visible";

      new simpleDatatables.DataTable(tableEl, {
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

<?php include 'tambah-pasien.php'; ?>

</html>