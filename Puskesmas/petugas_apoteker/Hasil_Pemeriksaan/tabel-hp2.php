<?php
require 'function-hp.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <?php
  include '../link.php';
  ?>

</head>

<body>

  <?php
  include '../header.php';
  include '../siderbar.php';
  ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Kelola Data Hasil Pemeriksaan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
          <li class="breadcrumb-item active">Kelola Data Hasil Pemeriksaan</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->



    <div class="card mb-4">
      <div class="card-header">
        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">
          <i class="fa fa-plus">
            Tambah Data
          </i></button>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table datatable table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Ruang Pelayanan</th>
                <th>Nama Pasien</th>
                <th>NIK Pasien</th>
                <th>Tanggal Lahir</th>
                <th>L/P</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>

              <?php
              $ambilsemuahasil = mysqli_query($conn, "SELECT * FROM hasil_pemeriksaan");
              $i = 1;
              while ($data = mysqli_fetch_array($ambilsemuahasil)) {
                $nama_dokter = $data['nama_dokter'];
                $jk_dokter = $data['jk_dokter'];
                $agama_dokter = $data['agama_dokter'];
                $idh = $data['nip_dokter'];
                $status_pernikahan_dokter = $data['status_pernikahan_dokter'];
                $status_dokter = $data['status_dokter'];
                $alamat_dokter = $data['alamat_dokter'];
              ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= $idh; ?></td>
                  <td><?= $nama_dokter; ?></td>
                  <td><?= $jk_dokter; ?></td>
                  <td><?= $agama_dokter; ?></td>
                  <td><?= $status_pernikahan_dokter; ?></td>
                  <td><?= $status_dokter; ?></td>
                  <td><?= $alamat_dokter; ?></td>
                  <td><?= $no_hp_dokter; ?></td>
                  <td>

                    <div class="btn-group" role="group" aria-label="Basic example">
                      <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#update<?= $idh; ?>"><i class="bi bi-pencil-square"></i></button>
                      <input type="hidhen" nama="idhasilygmaudihapus" value="<?= $idh; ?>">
                      <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?= $idh; ?>"><i class=" bi bi-trash-fill"></i></button>
                    </div>

                  </td>
                </tr>

                <?php
                include 'update-hp.php';

                include 'delete-hp.php';
                ?>

              <?php
              };

              ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>



  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
  include '../footer.php';
  ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

<?php
include 'tambah-hp.php';
?>

</html>