<?php
session_name("PASIEN_SESSION");
session_start();
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if ($_SESSION['role'] !== 'pasien' || empty($_SESSION['pasien_nik'])) {
  echo "<script> window.location = '../login/login-pasien.php' </script>";
  exit();
}

$id = $_GET["id_pengumuman"];
$ambil = mysqli_query($conn, "SELECT * FROM pengumuman WHERE id_pengumuman = '$id'");

if (!$ambil || mysqli_num_rows($ambil) == 0) {
  echo "<div class='alert alert-danger mt-4'>❌ Pengumuman tidak ditemukan atau ID tidak valid.</div>";
  echo "<a href='index.php' class='btn btn-secondary mt-2'>← Kembali</a>";
  exit;
}

$pengumuman  = mysqli_fetch_array($ambil);



// Cek apakah pengumuman ini masih baru
date_default_timezone_set("Asia/Jakarta");
$tanggal = $pengumuman["tgl_pengumuman"] ?? null;
$selisih_hari = $tanggal ? (strtotime(date("Y-m-d")) - strtotime($tanggal)) / (60 * 60 * 24) : 999;
$isBaru = $selisih_hari <= 7;



?>


<!DOCTYPE html>
<html lang="id">

<head>
  <?php include '../link.php'; ?>
</head>

<body>
  <?php include '../header.php';
  include '../siderbar.php'; ?>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Detail Pengumuman</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Pengumuman</a></li>
          <li class="breadcrumb-item active"><?php echo $pengumuman['judul_pengumuman']; ?></li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <?php
      $ambilpengumuman = mysqli_query($conn, "SELECT * FROM pengumuman WHERE id_pengumuman = '$id'");
      while ($data = mysqli_fetch_array($ambilpengumuman)) {
      ?>

        <div class="row">
          <div class="col-lg-6">

            <div class="card">
              <img src="../../adm/Kelola_Pengumuman/img/<?php echo $data["foto_pengumuman"]; ?>" class="card-img-top img-thumbnail">
            </div>

          </div>

          <div class="col-lg-6">

            <!-- Card with header and footer -->
            <div class="card">
              <div class="card-header">
                <h5> <?php echo $data["judul_pengumuman"]; ?> </h5>
              </div>
              <br>
              <div class="card-body">
                <?php echo $data["keterangan_pengumuman"]; ?>
              </div>
              <div class="card-footer ">
                <strong>Tanggal Pengumuman</strong>:<?php echo $data["tgl_pengumuman"]; ?>
              </div>
              <div class="card-body text-end">
                <a href="index.php" class="btn btn-outline-secondary btn-sm">← Kembali ke Daftar</a>
              </div>
            </div><!-- End Card with header and footer -->

          </div>
        </div>

      <?php
      };
      ?>

    </section>
  </main>

  <?php include '../footer.php'; ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/main.js"></script>
</body>

</html>