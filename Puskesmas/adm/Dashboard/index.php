<?php
session_name("ADMIN_SESSION");
session_start();
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if ($_SESSION['role'] !== 'admin' || empty($_SESSION['admin_id'])) {
  echo "<script> window.location = '../login/login-admin.php' </script>";
  exit();
}

// Query jumlah
$totalPasien = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM pasien"))['total'];
$totalDokter = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM dokter"))['total'];
$totalPetugas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM petugas"))['total'];
$totalKunjungan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM rekam_medis WHERE status_dokter = 'Sudah Diperiksa'"))['total'];
// Ambil ruang fleksibel
$kunjunganPerRuang = [];
$namaRuang = [];
$queryRuang = mysqli_query($conn, "SELECT id_ruang, nama_ruang FROM ruang WHERE tipe_ruang = 'pelayanan'");
while ($ruang = mysqli_fetch_assoc($queryRuang)) {
  $id = $ruang['id_ruang'];
  $namaRuang[$id] = $ruang['nama_ruang'];
  $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM rekam_medis WHERE id_ruang = $id AND status_dokter = 'Sudah Diperiksa'");
  $kunjunganPerRuang[$id] = mysqli_fetch_assoc($result)['total'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include '../link.php'; ?>
  <style>
    .chart-container {
      position: relative;
      max-width: 100%;
      height: 400px !important;
      width: 100% !important;
    }

    canvas {
      max-height: 400px !important;
      width: 100% !important;
    }

    .card-stat {
      transition: transform 0.2s ease, box-shadow 0.3s ease;
      border: none;
      border-radius: 12px;
    }

    .card-stat:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
    }

    .card-stat .icon-wrapper {
      width: 50px;
      height: 50px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      color: #fff;
    }

    .card-stat h6 {
      font-weight: 600;
      margin-bottom: 4px;
      color: #555;
    }

    .card-stat h4 {
      font-weight: 700;
      color: #111;
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <?php include '../header.php'; ?>
  <?php include '../siderbar.php'; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active"><a href="index.php">Dashboard</a></li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card card-stat shadow-sm p-3">
            <div class="d-flex align-items-center">
              <div class="icon-wrapper bg-primary me-3">
                <i class="bi bi-people-fill"></i>
              </div>
              <div>
                <h6>Total Pasien</h6>
                <h4><?= $totalPasien ?></h4>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card card-stat shadow-sm p-3">
            <div class="d-flex align-items-center">
              <div class="icon-wrapper bg-success me-3">
                <i class="bi bi-person-badge-fill"></i>
              </div>
              <div>
                <h6>Total Dokter</h6>
                <h4><?= $totalDokter ?></h4>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card card-stat shadow-sm p-3">
            <div class="d-flex align-items-center">
              <div class="icon-wrapper bg-warning me-3">
                <i class="bi bi-person-vcard-fill"></i>
              </div>
              <div>
                <h6>Total Petugas</h6>
                <h4><?= $totalPetugas ?></h4>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card card-stat shadow-sm p-3">
            <div class="d-flex align-items-center">
              <div class="icon-wrapper bg-danger me-3">
                <i class="bi bi-clipboard2-pulse-fill"></i>
              </div>
              <div>
                <h6>Total Kunjungan</h6>
                <h4><?= $totalKunjungan ?></h4>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <?php foreach ($kunjunganPerRuang as $id => $jumlah): ?>
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="card card-stat shadow-sm p-3">
              <div class="d-flex align-items-center">
                <div class="icon-wrapper bg-secondary me-3">
                  <i class="bi bi-door-closed-fill"></i>
                </div>
                <div>
                  <h6><?= $namaRuang[$id] ?></h6>
                  <h4><?= $jumlah ?></h4>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="pagetitle">
        <nav>
          <label for="tahun_kunjungan">Pilih Tahun:</label>
          <select id="tahun_kunjungan" class="form-select w-auto d-inline-block" onchange="loadAllCharts()">
            <?php
            $currentYear = date('Y');
            for ($i = $currentYear; $i >= $currentYear - 5; $i--) {
              echo "<option value='$i'>$i</option>";
            }
            ?>
          </select>
          <button onclick="resetYear()" class="btn btn-secondary ms-2">Refresh</button>
        </nav>
      </div>

      <!-- Grafik Kunjungan Pasien -->
      <div class="col-lg-12 mt-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Grafik Jumlah Kunjungan Pasien Selama Setahun</h5>
            <div class="chart-container">
              <canvas id="kunjunganChart"></canvas>
            </div>
          </div>
        </div>
      </div>

      <!-- Grafik Distribusi Usia Pasien -->
      <div class="col-lg-12 mt-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Grafik Jumlah Usia Pasien per Jenis Kelamin</h5>
            <div class="chart-container">
              <canvas id="usiaChart"></canvas>
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

  <!-- Vendor JS -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/js/main.js"></script>

  <!-- Custom Chart Script -->
  <script>
    let kunjunganChart = null;
    let usiaChart = null;

    document.addEventListener('DOMContentLoaded', () => {
      document.getElementById('tahun_kunjungan').value = new Date().getFullYear();
      loadAllCharts();
    });

    function resetYear() {
      const currentYear = new Date().getFullYear();
      document.getElementById('tahun_kunjungan').value = currentYear;
      loadAllCharts();
    }

    function loadAllCharts() {
      loadKunjunganChart();
      loadUsiaChart();
      loadRuangChart();
    }

    async function loadKunjunganChart() {
      const tahun = document.getElementById('tahun_kunjungan').value;
      const response = await fetch(`./api/chart_api.php?chart=kunjungan&year=${tahun}`);
      const data = await response.json();

      const ctx = document.getElementById('kunjunganChart').getContext('2d');
      if (kunjunganChart) kunjunganChart.destroy();

      kunjunganChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: data.labels,
          datasets: [{
              label: 'Laki-Laki',
              data: data.male_data,
              backgroundColor: 'rgba(54, 162, 235, 0.7)'
            },
            {
              label: 'Perempuan',
              data: data.female_data,
              backgroundColor: 'rgba(255, 99, 132, 0.7)'
            }
          ]
        },
        options: {
          responsive: true,
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                stepSize: 1
              }
            }
          }
        }
      });
    }

    async function loadUsiaChart() {
      const tahun = document.getElementById('tahun_kunjungan').value;
      const response = await fetch(`./api/chart_api.php?chart=usia&year=${tahun}`);
      const data = await response.json();

      const ctx = document.getElementById('usiaChart').getContext('2d');
      if (usiaChart) usiaChart.destroy();

      usiaChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: data.labels,
          datasets: [{
              label: 'Laki-Laki',
              data: data.male_data,
              backgroundColor: 'rgba(54, 162, 235, 0.7)'
            },
            {
              label: 'Perempuan',
              data: data.female_data,
              backgroundColor: 'rgba(255, 99, 132, 0.7)'
            }
          ]
        },
        options: {
          responsive: true,
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                stepSize: 2
              }
            }
          }
        }
      });
    }
  </script>

</body>

</html>