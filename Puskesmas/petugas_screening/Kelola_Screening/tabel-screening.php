<?php
session_name("SCREENING_SESSION");
session_start();
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if ($_SESSION['role'] !== 'screening' || empty($_SESSION['screening_nip'])) {
  echo "<script> window.location = '../login/login-petugas.php' </script>";
  exit();
}

require 'function-screening.php';
?>
<!DOCTYPE html>
<html lang="id">

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
      <h1>Kelola Data Screening</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Kelola Data Screening</li>
        </ol>
      </nav>
    </div>

    <section class="section profile">
      <div class="row">
        <div class="col-xl">
          <div class="card">
            <div class="card-body pt-3">
              <div class="tab-content pt-2">
                <h5 class="card-title">Screening Hari Ini</h5>
                <div class="card mb-4">
                  <div class="card-header">
                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">
                      Tambah Data
                    </button>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-hover table-bordered table-striped hidden-until-ready" id="dataTable">
                        <thead class="table-primary">
                          <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Pasien</th>
                            <th>NIK</th>
                            <th>Keluhan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          date_default_timezone_set('Asia/Jakarta');
                          $today = date('Y-m-d');
                          $ambilsemuarm = mysqli_query($conn, "SELECT * FROM rekam_medis a LEFT JOIN pasien b ON a.nik_pasien=b.nik_pasien WHERE tgl_pemeriksaan = '$today' ORDER BY id_rm DESC");
                          $i = 1;
                          while ($data = mysqli_fetch_array($ambilsemuarm)) {
                            $id_rm = $data['id_rm'];
                            $nik_pasien  = $data['nik_pasien'];
                            $tgl_pemeriksaan = $data['tgl_pemeriksaan'];
                            $sakit = $data['sakit'];
                            $nama_pasien = $data['nama_pasien'];
                            $badge = ($data['status_screening'] === 'Sudah Diperiksa') ? '<span class="badge bg-success">Sudah Diperiksa</span>' : '<span class="badge bg-danger">Belum Diperiksa</span>';
                          ?>
                            <tr>
                              <td><?= $i++; ?></td>
                              <td><?= $tgl_pemeriksaan; ?></td>
                              <td><?= htmlspecialchars($nama_pasien); ?></td>
                              <td><?= $nik_pasien; ?></td>
                              <td><?= $sakit; ?></td>
                              <td><?= $badge; ?></td>
                              <td class="text-center">
                                <a type="button" class="btn btn-primary btn-sm" href="detail-screening.php?id_rm=<?= $data['id_rm']; ?>">
                                  <i class="bi bi-pencil-square"></i>
                                </a>
                              </td>
                            </tr>
                            <?php include 'perbarui-screening.php';
                            include 'hapus-screening.php'; ?>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
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
  <!-- Tambahkan Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#nik_pasien').select2({
        dropdownParent: $('#ExtralargeModal'), // Penting supaya select2 muncul di modal
        placeholder: 'Cari NIK Pasien...',
        minimumInputLength: 2,
        ajax: {
          url: 'cari_nik.php', // file php untuk ambil nik
          type: 'POST',
          dataType: 'json',
          delay: 250,
          data: function(params) {
            return {
              search: params.term
            };
          },
          processResults: function(data) {
            return {
              results: data
            };
          },
          cache: true
        }
      });
    });
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const tableEl = document.querySelector("#dataTable");
      tableEl.classList.remove("hidden-until-ready");
      tableEl.style.visibility = "visible";

      const dataTable = new simpleDatatables.DataTable(tableEl, {
        labels: {
          noRows: "Tidak ada data screening.",
          placeholder: "Cari...",
          perPage: "Data per halaman",
          noResults: "Tidak ditemukan hasil yang cocok",
          info: "Menampilkan {start} sampai {end} dari total {rows} data"
        }
      });
    });
  </script>
</body>

<?php include 'tambah-screening.php'; ?>

</html>