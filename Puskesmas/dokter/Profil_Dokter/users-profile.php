<?php
session_name("DOKTER_SESSION");
session_start(); //memulai apabila ada login
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

// Validasi Login Dokter
if ($_SESSION['role'] !== 'dokter' || empty($_SESSION['dokter_nip'])) {
  echo "<script> window.location = '../login/login-dokter.php' </script>";
  exit();
}

require 'function-profil.php';
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

    <?php
    $nip_dok = $_SESSION['dokter_nip'];

    $tampildokter = mysqli_query($conn, "SELECT * FROM dokter a left join ruang b on a.id_ruang=b.id_ruang WHERE nip_dokter='$nip_dok'");
    while ($data = mysqli_fetch_array($tampildokter)) {
      $foto_dokter = $data['foto_dokter'];
      $nama_dokter = $data['nama_dokter'];
      $jk_dokter = $data['jk_dokter'];
      $agama_dokter = $data['agama_dokter'];
      $nip_dokter = $data['nip_dokter'];
      $idd = $data['nip_dokter'];
      $status_pernikahan_dokter = $data['status_pernikahan_dokter'];
      $status_dokter = $data['status_dokter'];
      $alamat_dokter = $data['alamat_dokter'];
      $no_hp_dokter = $data['no_hp_dokter'];
      $password_dokter = $data['password_dokter'];
      $tempat_lahir_dokter = $data['tempat_lahir_dokter'];
      $tgl_lahir_dokter = $data['tgl_lahir_dokter'];
      $id_ruang = $data['id_ruang'];
      $nama_ruang = $data['nama_ruang'];

    ?>

      <div class="pagetitle">
        <h1>Profil Dokter</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Profil Dokter</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->

      <section class="section profile">


        <div class="row">
          <div class="col-xl-4">

            <div class="card">
              <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                <img src="../../adm/Kelola_Dokter/img/<?php echo $data['foto_dokter']; ?>" alt="<?php echo $data['foto_dokter']; ?>" class="rounded-circle">
                <h2><?php echo $data['nama_dokter']; ?></h2>

              </div>
            </div>

          </div>

          <div class="col-xl-8">

            <div class="card">
              <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">

                  <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Profil</button>
                  </li>

                </ul>

                <div class="tab-content pt-2">

                  <div class="tab-pane fade show active profile-overview" id="profile-overview">
                    <h5 class="card-title">Profil Detail</h5>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Nama</div>
                      <div class="col-lg-9 col-md-8"><?php echo $data['nama_dokter']; ?></div>
                    </div>


                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">NIP</div>
                      <div class="col-lg-9 col-md-8"><?php echo $data['nip_dokter']; ?></div>
                    </div>


                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Jenis Kelamin</div>
                      <div class="col-lg-9 col-md-8"><?php echo $data['jk_dokter']; ?></div>
                    </div>


                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Tempat Lahir</div>
                      <div class="col-lg-9 col-md-8"><?= $tempat_lahir_dokter; ?></div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Tanggal Lahir</div>
                      <div class="col-lg-9 col-md-8"><?= $tgl_lahir_dokter; ?></div>
                    </div>


                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Agama</div>
                      <div class="col-lg-9 col-md-8"><?php echo $data['agama_dokter']; ?></div>
                    </div>


                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Status Pernikahan</div>
                      <div class="col-lg-9 col-md-8"><?php echo $data['status_pernikahan_dokter']; ?></div>
                    </div>


                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Ruang Pelayanan</div>
                      <div class="col-lg-9 col-md-8"><?php echo $data['nama_ruang']; ?></div>
                    </div>


                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Alamat</div>
                      <div class="col-lg-9 col-md-8"><?php echo $data['alamat_dokter']; ?></div>
                    </div>


                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Nomor HP</div>
                      <div class="col-lg-9 col-md-8"><?php echo $data['no_hp_dokter']; ?></div>
                    </div>

                  </div>

                </div>
              </div>

            </div>
          </div>

      </section>

    <?php
    };
    ?>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
  include '../footer.php';
  ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>