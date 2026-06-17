<?php
session_name("ADMIN_SESSION");
session_start(); //memulai apabila ada login
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

//jika tidak ada login sebelumnya maka diarahkan ke login.php
if ($_SESSION['role'] !== 'admin' || empty($_SESSION['admin_id'])) {
  echo "<script> window.location = '../login/login-admin.php' </script>";
  exit();
}

require 'function-obat.php';

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
      <h1>Kelola Data Obat</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Kelola Data Obat</li>
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
                <th>Kode Obat</th>
                <th>Nama Obat</th>
                <th>Dosis Obat</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>

              <?php
              $ambilsemuahasil = mysqli_query($conn, "SELECT * FROM obat");
              $i = 1;
              while ($data = mysqli_fetch_array($ambilsemuahasil)) {
                $ido = $data['kode_obat'];
                $nama_obat = $data['nama_obat'];
                $dosis_obat = $data['dosis_obat'];
                $keterangan_obat = $data['keterangan_obat'];
              ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td>OBAT-<?= $ido; ?></td>
                  <td><?= $nama_obat; ?></td>
                  <td><?= $dosis_obat; ?></td>
                  <td>

                    <div class="btn-group" role="group" aria-label="Basic example">
                      <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#updateobat<?= $ido; ?>"><i class="bi bi-pencil-square"></i></button>
                      <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteobat<?= $ido; ?>"><i class=" bi bi-trash-fill"></i></button>
                    </div>

                  </td>
                </tr>

                <?php
                include 'update-obat.php';

                include 'delete-obat.php';
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
include 'tambah-obat.php';
?>

</html>