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

require 'function-hp.php';
$detail = $_GET["rm"];
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
      <h1>Hasil Pemeriksaan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="tabel-pasien.php">Kelola Data Pasien</a></li>
          <li class="breadcrumb-item active">Rekam Medis</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

      <div class="row">

        <div class="col-xl">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-1">Ruang Pemeriksaan Umum</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link " data-bs-toggle="tab" data-bs-target="#profile-2">Ruang Pemeriksaan KIA-KB</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link " data-bs-toggle="tab" data-bs-target="#profile-3">Ruang Pemeriksaan Gigi</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link " data-bs-toggle="tab" data-bs-target="#profile-4">Ruang Pemeriksaan ILI</button>
                </li>

              </ul>


              <div class="tab-content pt-2">

                <?php
                include 'umum.php';

                include 'kb.php';

                include 'gigi.php';

                include 'ili.php';
                ?>

              </div>


            </div>

          </div>
        </div>

    </section>

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