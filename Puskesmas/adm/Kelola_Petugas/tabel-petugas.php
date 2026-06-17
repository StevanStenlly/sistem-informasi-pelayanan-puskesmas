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

require 'function-petugas.php';
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
      <h1>Kelola Data Petugas</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Kelola Data Petugas</li>
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
                <th>Foto Petugas</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Ruang Pelayanan</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>

              <?php
              $ambilsemuapetugas = mysqli_query($conn, "SELECT * FROM petugas a left join ruang b on a.id_ruang=b.id_ruang");
              $i = 1;
              while ($data = mysqli_fetch_array($ambilsemuapetugas)) {
                $foto_petugas = $data['foto_petugas'];
                $nama_petugas = $data['nama_petugas'];
                $nip_petugas = $data['nip_petugas'];
                $id_ruang = $data['id_ruang'];
                $nama_ruang = $data['nama_ruang'];
                $tempat_lahir_petugas = $data['tempat_lahir_petugas'];
                $tgl_lahir_petugas = $data['tgl_lahir_petugas'];
              ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><img src="img/<?php echo $foto_petugas; ?>" alt="<?php echo $foto_petugas; ?>" height="80" width="80"></td>
                  <td><?= $nama_petugas; ?></td>
                  <td><?= $nip_petugas; ?></td>
                  <td><?= $nama_ruang; ?></td>
                  <td>

                    <div class="btn-group" role="group" aria-label="Basic example">
                      <input type="hidden" nama="idpetugasygmaudihapus" value="<?= $nip_petugas; ?>">
                      <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?= $nip_petugas; ?>"><i class=" bi bi-trash-fill"></i></button>
                      <a type="button" class="btn btn-primary btn-sm" href="detail-petugas.php?nip_petugas=<?php echo $data["nip_petugas"]; ?>"><i class=" bi bi-eye-fill"></i></a>
                    </div>

                  </td>
                </tr>


                <?php
                include 'perbarui-petugas.php';
                include 'hapus-petugas.php';
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
include 'tambah-petugas.php';
?>

</html>