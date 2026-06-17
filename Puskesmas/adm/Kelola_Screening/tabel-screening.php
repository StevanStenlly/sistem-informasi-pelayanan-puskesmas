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

require 'function-screening.php';
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
      <h1>Kelola Data Screening</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Kelola Data Screening</li>
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
        </button>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table datatable table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Pasien</th>
                <th>NIK</th>
                <th>NO.Rekam Medis</th>
                <th>Tanggal Lahir</th>
                <th>L/P</th>
                <th>Keluhan</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>

              <?php
              $ambilsemuascreening = mysqli_query($conn, "SELECT * FROM rekam_medis 
              a left join pasien b on a.nik_pasien=b.nik_pasien  ORDER BY id_rm DESC ");
              $i = 1;
              while ($data = mysqli_fetch_array($ambilsemuascreening)) {
                $id_rm = $data['id_rm'];
                $nik_pasien  = $data['nik_pasien'];
                $tgl_pemeriksaan = $data['tgl_pemeriksaan'];
                $sakit = $data['sakit'];
                $nama_pasien = $data['nama_pasien'];
                $ttl_pasien = $data['ttl_pasien'];
                $jk_pasien = $data['jk_pasien'];
                $status = $data['status'];
              ?>

                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= $tgl_pemeriksaan; ?></td>
                  <td><?= $nama_pasien; ?></td>
                  <td><?= $nik_pasien; ?></td>
                  <td><?= $ttl_pasien; ?></td>
                  <td><?= $jk_pasien; ?></td>
                  <td><?= $sakit; ?></td>
                  <td><?= $status; ?>
                    <p></p>
                    <a href="status-confirmed.php?id_rm=<?php echo $id_rm; ?>"> <button type="button" class="btn btn-info btn-sm"><i class="bi bi-check"></i></button></a>
                    <a href="status-nonconf.php?id_rm=<?php echo $id_rm; ?>"><button type="button" class="btn btn-danger btn-sm"><i class="bi bi-x"></i></button></a>
                  </td>
                  <td>

                    <div class="btn-group" role="group" aria-label="Basic example">
                      <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#updatescreening<?= $id_rm; ?>"><i class="bi bi-pencil-square"></i></button>
                      <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletescreening<?= $id_rm; ?>"><i class=" bi bi-trash-fill"></i></button>
                      <a type="button" class="btn btn-primary btn-sm" href="detail-screening.php?id_rm=<?php echo $data["id_rm"]; ?>"><i class=" bi bi-eye-fill"></i></a>
                    </div>

                  </td>
                </tr>

                <?php
                include 'perbarui-screening.php';
                include 'hapus-screening.php';
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
include 'tambah-screening.php';
?>

</html>