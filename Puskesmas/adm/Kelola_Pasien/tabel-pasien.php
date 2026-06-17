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

require 'function-pasien.php';
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
      <h1>Kelola Data Pasien</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Kelola Data Pasien</li>
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
                <th>Foto Pasien</th>
                <th>Nomor Kartu Pasien</th>
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
                $jk_pasien = $data['jk_pasien'];
                $agama_pasien = $data['agama_pasien'];
                $idps = $data['nik_pasien'];
                $status_pernikahan_pasien = $data['status_pernikahan_pasien'];
                $alamat_pasien = $data['alamat_pasien'];
                $no_hp_pasien = $data['no_hp_pasien'];
                $password_pasien = $data['password_pasien'];
                $pekerjaan_pasien = $data['pekerjaan_pasien'];
                $riwayat_alergi_pasien = $data['riwayat_alergi_pasien'];
                $tempat_lahir_pasien = $data['tempat_lahir_pasien'];
                $tgl_lahir_pasien = $data['tgl_lahir_pasien'];
                $rm = $data['rm'];
                $bpjs = $data['bpjs'];
              ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><img src="img/<?php echo $foto_pasien; ?>" alt="<?php echo $foto_pasien; ?>" height="80" width="80"></td>
                  <td>K-<?= $rm; ?></td>
                  <td><?= $nama_pasien; ?></td>
                  <td><?= $idps; ?></td>
                  <td>

                    <div class="btn-group" role="group" aria-label="Basic example">
                      <input type="hidden" nama="idpasienygmaudihapus" value="<?= $idps; ?>">
                      <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?= $idps; ?>"><i class=" bi bi-trash-fill"></i></button>
                      <a type="button" class="btn btn-primary btn-sm" href="detail-pasien.php?nik_pasien=<?php echo $data["nik_pasien"]; ?>"><i class=" bi bi-eye-fill"></i></a>
                      <a type="button" class="btn btn-success btn-sm" href="tabel-rm.php?rm=<?php echo $data["rm"]; ?>"><i class=" bi bi-archive-fill"></i></a>
                    </div>

                  </td>
                </tr>

                <?php
                include 'perbarui-pasien.php';
                include 'hapus-pasien.php';
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
include 'tambah-pasien.php';
?>

</html>