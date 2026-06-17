<?php
// Inisialisasi sesi khusus untuk pasien
session_name("PASIEN_SESSION");
session_start();
session_regenerate_id(true); // Untuk mencegah session fixation

include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

// Cek apakah pasien sudah login dan punya hak akses
if ($_SESSION['role'] !== 'pasien' || empty($_SESSION['pasien_nik'])) {
  echo "<script> window.location = '../login/login-pasien.php' </script>";
  exit();
}

require 'function-profil.php';

// Ambil data pasien berdasarkan NIK dari session
$nik_pas = $_SESSION['pasien_nik'];
$stmt = mysqli_prepare($conn, "SELECT * FROM pasien WHERE nik_pasien = ?");
mysqli_stmt_bind_param($stmt, "s", $nik_pas);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

// Jika data tidak ditemukan, redirect kembali
if (!$data) {
  echo "<script>alert('Data pasien tidak ditemukan'); window.location='../Dashboard/index.php'</script>";
  exit();
}

// Simpan setiap kolom data ke variabel, gunakan fallback default jika kosong
$foto_pasien = $data['foto_pasien'] ?? 'default.png';
$nama_pasien = $data['nama_pasien'] ?? '-';
$jk_pasien = $data['jk_pasien'] ?? '-';
$agama_pasien = $data['agama_pasien'] ?? '-';
$nik_pasien = $data['nik_pasien'] ?? '-';
$idps = $nik_pasien;
$status_pernikahan_pasien = $data['status_pernikahan_pasien'] ?? '-';
$alamat_pasien = $data['alamat_pasien'] ?? '-';
$no_hp_pasien = $data['no_hp_pasien'] ?? '-';
$password_pasien = $data['password_pasien'] ?? '-';
$tempat_lahir_pasien = $data['tempat_lahir_pasien'] ?? '-';
$tgl_lahir_pasien = $data['tgl_lahir_pasien'] ?? '-';
$pekerjaan_pasien = $data['pekerjaan_pasien'] ?? '-';
$riwayat_alergi_pasien = $data['riwayat_alergi_pasien'] ?? '-';
$rm = $data['rm'] ?? '-';
$bpjs = $data['bpjs'] ?? '-';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include '../link.php'; ?>
</head>

<body>
  <?php
  include '../header.php';
  include '../siderbar.php';
  ?>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Profil Pasien</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Profil Pasien</li>
        </ol>
      </nav>
    </div>

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">
          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              <!-- Menampilkan gambar dan nama pasien -->
              <img src="../../adm/Kelola_Pasien/img/<?= htmlspecialchars($foto_pasien); ?>" alt="<?= htmlspecialchars($foto_pasien); ?>" class="rounded-circle">
              <h2><?= htmlspecialchars($nama_pasien); ?></h2>
            </div>
          </div>
        </div>

        <div class="col-xl-8">
          <div class="card">
            <div class="card-body pt-3">
              <!-- Tab navigasi: Profil & Edit -->
              <ul class="nav nav-tabs nav-tabs-bordered">
                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Profil</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Ubah Profile</button>
                </li>
              </ul>

              <div class="tab-content pt-2">
                <!-- Tab Profil -->
                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Profil Detail</h5>
                  <?php
                  // Fungsi bantu untuk menampilkan data label dan nilai dengan layout grid Bootstrap
                  function tampilBaris($label, $nilai)
                  {
                    echo "<div class='row'><div class='col-lg-3 col-md-4 label '>$label</div><div class='col-lg-9 col-md-8'>" . htmlspecialchars($nilai) . "</div></div>";
                  }

                  // Tampilkan data pasien
                  tampilBaris("Nama", $nama_pasien);
                  tampilBaris("NIK", $nik_pasien);
                  tampilBaris("BPJS", $bpjs);
                  tampilBaris("NO.Rekam Medis", "K-$rm");
                  tampilBaris("Jenis Kelamin", $jk_pasien);
                  tampilBaris("Tempat Lahir", $tempat_lahir_pasien);
                  tampilBaris("Tanggal Lahir", $tgl_lahir_pasien);
                  tampilBaris("Agama", $agama_pasien);
                  tampilBaris("Status Pernikahan", $status_pernikahan_pasien);
                  tampilBaris("Pekerjaan", $pekerjaan_pasien);
                  tampilBaris("Riwayat Alergi", $riwayat_alergi_pasien);
                  tampilBaris("Alamat", $alamat_pasien);
                  tampilBaris("Nomor HP", $no_hp_pasien);
                  ?>
                </div>

                <!-- Tab Edit Profil -->
                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                  <?php include 'update-profile.php'; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include '../footer.php'; ?>
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
  <script src="../assets/js/main.js"></script>
</body>

</html>