<?php
session_name("PASIEN_SESSION");
session_start();
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if ($_SESSION['role'] !== 'pasien' || empty($_SESSION['pasien_nik'])) {
  echo "<script> window.location = '../login/login-pasien.php' </script>";
  exit();
}

$nik_pasien = $_SESSION['pasien_nik'];
$queryPasien = mysqli_query($conn, "SELECT * FROM pasien WHERE nik_pasien='$nik_pasien'");
$dataPasien = mysqli_fetch_assoc($queryPasien);

$jadwalHariIni = mysqli_query($conn, "
  SELECT * FROM rekam_medis
  WHERE nik_pasien = '$nik_pasien'
    AND tgl_pemeriksaan = CURDATE()
  ORDER BY waktu_pemeriksaan ASC
  LIMIT 1
");

$dataJadwal = mysqli_fetch_assoc($jadwalHariIni);

?>
<!DOCTYPE html>
<html lang="id">

<head>
  <?php include '../link.php'; ?>
  <style>
    .card-quicklink a {
      text-decoration: none;
      color: inherit;
    }

    .card-quicklink:hover {
      background-color: #f0f8ff;
    }
  </style>
</head>

<body>
  <?php include '../header.php';
  include '../siderbar.php'; ?>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">
        <div class="col-12">
          <div class="alert alert-info">
            <strong>Selamat datang, <?= htmlspecialchars($dataPasien['nama_pasien']) ?>!</strong><br>
            NIK: <?= $dataPasien['nik_pasien'] ?> | Jenis Kelamin: <?= $dataPasien['jk_pasien'] ?><br>
            Status Profil: <?= empty($dataPasien['alamat_pasien']) ? '<span class="text-danger">Belum Lengkap</span>' : '<span class="text-success">Lengkap</span>' ?>
          </div>
        </div>
      </div>

      <div class="row">
        <?php
        $queryLast = mysqli_query($conn, "SELECT * FROM rekam_medis WHERE nik_pasien='$nik_pasien' ORDER BY tgl_pemeriksaan DESC LIMIT 1");
        $lastVisit = mysqli_fetch_assoc($queryLast);
        ?>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header bg-primary text-white">Kunjungan Terakhir</div>
            <div class="card-body">
              <?php if ($lastVisit): ?>
                <p><strong>Tanggal:</strong> <?= date('d-m-Y', strtotime($lastVisit['tgl_pemeriksaan'])) ?></p>
                <p><strong>Keluhan:</strong> <?= htmlspecialchars($lastVisit['sakit']) ?></p>
                <p><strong>Status:</strong> <?= $lastVisit['status_dokter'] ?></p>
              <?php else: ?>
                <p class="text-muted">Belum ada riwayat pemeriksaan.</p>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card">
            <div class="card-header bg-success text-white">Jadwal Kunjungan Hari Ini</div>
            <div class="card-body">
              <?php if ($dataJadwal): ?>
                <p><strong>Tanggal:</strong> <?= date('d-m-Y', strtotime($dataJadwal['tgl_pemeriksaan'])) ?></p>
                <p><strong>Status:</strong>
                  <?php
                  if ($dataJadwal['status_dokter'] === 'Sudah Diperiksa') {
                    echo "<span class='text-success'>Selesai</span>";
                  } else {
                    echo "<span class='text-warning'>Menunggu Pemeriksaan</span>";
                  }
                  ?>
                </p>
                <?php if ($dataJadwal['status_dokter'] !== 'Sudah Diperiksa'): ?>
                  <form action="batalkan_kunjungan.php" method="POST" onsubmit="return confirm('Yakin ingin membatalkan jadwal kunjungan hari ini?');">
                    <input type="hidden" name="id_rm" value="<?= $dataJadwal['id_rm'] ?>">
                    <button type="submit" class="btn btn-danger btn-sm mt-2">
                      <i class="bi bi-x-circle"></i> Batalkan Jadwal
                    </button>
                  </form>
                <?php endif; ?>

              <?php else: ?>
                <p class="text-muted">Anda tidak memiliki jadwal pemeriksaan hari ini.</p>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="row">
            <div class="col-12">
              <div class="card card-quicklink shadow-sm mb-3">
                <div class="card-body d-flex align-items-center">
                  <i class="bi bi-heart-pulse display-6 me-3 text-primary"></i>
                  <div>
                    <a href="../Pelayanan_Kesehatan/pelayanan_kesehatan.php">
                      <h6 class="mb-0">Riwayat Pelayanan</h6>
                      <small>Lihat semua pemeriksaan dan resep Anda</small>
                    </a>
                  </div>
                </div>
              </div>
              <div class="card card-quicklink shadow-sm mb-3">
                <div class="card-body d-flex align-items-center">
                  <i class="bi bi-person display-6 me-3 text-warning"></i>
                  <div>
                    <a href="../Profil_Pasien/users-profile.php">
                      <h6 class="mb-0">Profil Pasien</h6>
                      <small>Lihat dan perbarui data pribadi Anda</small>
                    </a>
                  </div>
                </div>
              </div>
              <!-- Placeholder tambahan untuk fitur mendatang -->
              <!-- <div class="card card-quicklink shadow-sm">
                <div class="card-body d-flex align-items-center">
                  <i class="bi bi-calendar-check display-6 me-3 text-success"></i>
                  <div>
                    <a href="#">
                      <h6 class="mb-0">Reservasi Kunjungan</h6>
                      <small>Fitur akan segera tersedia</small>
                    </a>
                  </div>
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include '../footer.php'; ?>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/js/main.js"></script>
</body>

</html>