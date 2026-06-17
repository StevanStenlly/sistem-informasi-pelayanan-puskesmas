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

require 'function-dokter.php';

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
      <h1>Kelola Data Dokter</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Kelola Data Dokter</li>
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
                <th>Foto Dokter</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Ruang Pelayanan</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>

              <?php
              $ambilsemuadokter = mysqli_query($conn, "SELECT * FROM dokter a left join ruang b on a.id_ruang=b.id_ruang");
              $i = 1;
              while ($data = mysqli_fetch_array($ambilsemuadokter)) {
                $foto_dokter = $data['foto_dokter'];
                $nama_dokter = $data['nama_dokter'];
                $jk_dokter = $data['jk_dokter'];
                $agama_dokter = $data['agama_dokter'];
                $nip_dokter = $data['nip_dokter'];
                $status_pernikahan_dokter = $data['status_pernikahan_dokter'];
                $status_dokter = $data['status_dokter'];
                $alamat_dokter = $data['alamat_dokter'];
                $no_hp_dokter = $data['no_hp_dokter'];
                $password_dokter = $data['password_dokter'];
                $ttl_dokter = $data['ttl_dokter'];
                $id_ruang = $data['id_ruang'];
                $nama_ruang = $data['nama_ruang'];
              ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><img src="img/<?php echo $foto_dokter; ?>" alt="<?php echo $foto_dokter; ?>" height="80" width="80"></td>
                  <td><?= $nama_dokter; ?></td>
                  <td><?= $nip_dokter; ?></td>
                  <td><?= $nama_ruang; ?></td>
                  <td>

                    <div class="btn-group" role="group" aria-label="Basic example">
                      <input type="hidden" nama="iddokterygmaudihapus" value="<?= $nip_dokter; ?>">
                      <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?= $nip_dokter; ?>"><i class=" bi bi-trash-fill"></i></button>
                      <a type="button" class="btn btn-primary btn-sm" href="detail-dokter.php?nip_dokter=<?php echo $data["nip_dokter"]; ?>"><i class=" bi bi-eye-fill"></i></a>
                    </div>

                  </td>
                </tr>

                <?php
                include 'update-dokter.php';

                include 'delete-dokter.php';
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
include 'tambah-dokter.php';
?>

</html>