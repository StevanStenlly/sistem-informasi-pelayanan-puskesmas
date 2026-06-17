<?php
session_name("SCREENING_SESSION");
session_start(); //memulai apabila ada login
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

//jika tidak ada login sebelumnya maka diarahkan ke login.php
if ($_SESSION['role'] !== 'screening' || empty($_SESSION['screening_nip'])) {
  echo "<script> window.location = '../login/login-petugas.php' </script>";
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
    $nip_pet = $_SESSION['screening_nip'];

    $tampilpetugas = mysqli_query($conn, "SELECT * FROM petugas a left join ruang b on a.id_ruang=b.id_ruang WHERE nip_petugas='$nip_pet'");
    while ($data = mysqli_fetch_array($tampilpetugas)) {
      $foto_petugas = $data['foto_petugas'];
      $nama_petugas = $data['nama_petugas'];
      $nip_petugas = $data['nip_petugas'];
      $idp = $data['nip_petugas'];
      $jk_petugas = $data['jk_petugas'];
      $tempat_lahir_petugas = $data['tempat_lahir_petugas'];
      $tgl_lahir_petugas = $data['tgl_lahir_petugas'];
      $agama_petugas = $data['agama_petugas'];
      $status_pernikahan_petugas = $data['status_pernikahan_petugas'];
      $status_petugas = $data['status_petugas'];
      $alamat_petugas = $data['alamat_petugas'];
      $no_hp_petugas = $data['no_hp_petugas'];
      $password_petugas = $data['password_petugas'];
      $id_ruang = $data['id_ruang'];
      $nama_ruang = $data['nama_ruang'];
    ?>

      <div class="pagetitle">
        <h1>Profil Petugas</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Profil Petugas</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->

      <section class="section profile">


        <div class="row">
          <div class="col-xl-4">

            <div class="card">
              <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                <img src="../../adm/Kelola_Petugas/img/<?php echo $data['foto_petugas']; ?>" alt="<?php echo $data['foto_petugas']; ?>" class="rounded-circle">
                <h2><?php echo $data['nama_petugas']; ?></h2>

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
                      <div class="col-lg-9 col-md-8"><?php echo $data['nama_petugas']; ?></div>
                    </div>


                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">NIP</div>
                      <div class="col-lg-9 col-md-8"><?php echo $data['nip_petugas']; ?></div>
                    </div>


                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Jenis Kelamin</div>
                      <div class="col-lg-9 col-md-8"><?php echo $data['jk_petugas']; ?></div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Tempat Lahir</div>
                      <div class="col-lg-9 col-md-8"><?= $tempat_lahir_petugas; ?></div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Tanggal Lahir</div>
                      <div class="col-lg-9 col-md-8"><?= $tgl_lahir_petugas; ?></div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Agama</div>
                      <div class="col-lg-9 col-md-8"><?php echo $data['agama_petugas']; ?></div>
                    </div>


                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Status Pernikahan</div>
                      <div class="col-lg-9 col-md-8"><?php echo $data['status_pernikahan_petugas']; ?></div>
                    </div>


                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Ruang Pelayanan</div>
                      <div class="col-lg-9 col-md-8"><?php echo $data['nama_ruang']; ?></div>
                    </div>


                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Alamat</div>
                      <div class="col-lg-9 col-md-8"><?php echo $data['alamat_petugas']; ?></div>
                    </div>


                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">NO HP</div>
                      <div class="col-lg-9 col-md-8"><?php echo $data['no_hp_petugas']; ?></div>
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