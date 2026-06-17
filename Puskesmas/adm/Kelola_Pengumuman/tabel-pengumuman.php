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

require 'function-pengumuman.php';
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
      <h1>Kelola Data Pengumuman</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Kelola Data Pengumuman</li>
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
                <th>Gambar</th>
                <th>Judul</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>

              <?php
              $ambilsemuapengumuman = mysqli_query($conn, "SELECT * FROM pengumuman ORDER BY id_pengumuman DESC");
              $i = 1;
              while ($data = mysqli_fetch_array($ambilsemuapengumuman)) {
                $foto_pengumuman = $data['foto_pengumuman'];
                $judul_pengumuman = $data['judul_pengumuman'];
                $keterangan_pengumuman = $data['keterangan_pengumuman'];
                $tgl_pengumuman = $data['tgl_pengumuman'];
                $idpg = $data['id_pengumuman'];
              ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><img src="img/<?php echo $foto_pengumuman; ?>" alt="<?php echo $foto_pengumuman; ?>" height="80" width="80"></td>
                  <td><?= $judul_pengumuman; ?></td>
                  <td><?= $keterangan_pengumuman; ?></td>
                  <td><?= $tgl_pengumuman; ?></td>
                  <td>

                    <div class="btn-group" role="group" aria-label="Basic example">
                      <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#update<?= $idpg; ?>"><i class="bi bi-pencil-square"></i></button>
                      <input type="hidden" nama="idpengumumanygmaudihapus" value="<?= $idpg; ?>">
                      <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?= $idpg; ?>"><i class=" bi bi-trash-fill"></i></button>
                    </div>

                  </td>
                </tr>

                <?php
                include 'perbarui-pengumuman.php';
                include 'hapus-pengumuman.php';
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
include 'tambah-pengumuman.php';
?>

</html>