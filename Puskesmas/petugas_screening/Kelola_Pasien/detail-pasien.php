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

$detail = $_GET["nik_pasien"];
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
    $tampilpasien = mysqli_query($conn, "SELECT * FROM pasien WHERE nik_pasien = '$detail'");
    $data = mysqli_fetch_array($tampilpasien);
    $foto_pasien = $data['foto_pasien'];
    $nama_pasien = $data['nama_pasien'];
    $jk_pasien = $data['jk_pasien'];
    $agama_pasien = $data['agama_pasien'];
    $nik_pasien = $data['nik_pasien'];
    $idps = $data['nik_pasien'];
    $status_pernikahan_pasien = $data['status_pernikahan_pasien'];
    $alamat_pasien = $data['alamat_pasien'];
    $no_hp_pasien = $data['no_hp_pasien'];
    $password_pasien = $data['password_pasien'];
    $tempat_lahir_pasien = $data['tempat_lahir_pasien'];
    $tgl_lahir_pasien = $data['tgl_lahir_pasien'];
    $bpjs = $data['bpjs'];
    $pekerjaan_pasien = $data['pekerjaan_pasien'];
    $riwayat_alergi_pasien = $data['riwayat_alergi_pasien'];
    $rm = $data['rm'];
    ?>

    <div class="pagetitle">
      <h1>Profil Pasien</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="tabel-pasien.php">Data Pasien</a></li>
          <li class="breadcrumb-item active">Profil Pasien</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">


      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <td><img src="../../adm/Kelola_Pasien/img/<?php echo $foto_pasien; ?>" alt="<?php echo $foto_pasien; ?>" class="rounded-circle"></td>
              <h2><?php echo $data['nama_pasien']; ?></h2>

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
                    <div class="col-lg-9 col-md-8"><?= $nama_pasien; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">NIK</div>
                    <div class="col-lg-9 col-md-8"><?= $nik_pasien; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">BPJS</div>
                    <div class="col-lg-9 col-md-8"><?= $bpjs; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">NO.Rekam Medis</div>
                    <div class="col-lg-9 col-md-8">K-<?= $rm; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Jenis Kelamin</div>
                    <div class="col-lg-9 col-md-8"><?= $jk_pasien; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Tempat Lahir</div>
                    <div class="col-lg-9 col-md-8"><?= $tempat_lahir_pasien; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Tanggal Lahir</div>
                    <div class="col-lg-9 col-md-8"><?= $tgl_lahir_pasien; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Agama</div>
                    <div class="col-lg-9 col-md-8"><?= $agama_pasien; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Status Pernikahan</div>
                    <div class="col-lg-9 col-md-8"><?= $status_pernikahan_pasien; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Pekerjaan</div>
                    <div class="col-lg-9 col-md-8"><?= $pekerjaan_pasien; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Riwayat Alergi</div>
                    <div class="col-lg-9 col-md-8"><?= $riwayat_alergi_pasien; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Alamat</div>
                    <div class="col-lg-9 col-md-8"><?= $alamat_pasien; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nomor HP</div>
                    <div class="col-lg-9 col-md-8"><?= $no_hp_pasien; ?></div>
                  </div>

                </div>

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