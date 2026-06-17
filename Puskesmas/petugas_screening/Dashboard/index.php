<?php
session_name("SCREENING_SESSION");
session_start();
require_once('../../koneksi.php');

if ($_SESSION['role'] !== 'screening' || empty($_SESSION['screening_nip'])) {
  echo "<script> window.location = '../login/login-petugas.php' </script>";
  exit();
}

if ($_SESSION['ruang_id'] != 5) {
  echo "<script> window.location = '../login/login-petugas.php' </script>";
  exit();
}

$nip_screening = $_SESSION['screening_nip'];
$id_ruang = $_SESSION['ruang_id'];
$today = date('Y-m-d');

$queryJumlahHariIni = mysqli_query($conn, "SELECT COUNT(*) AS total FROM rekam_medis WHERE tgl_pemeriksaan = '$today'");
$dataJumlahHariIni = mysqli_fetch_assoc($queryJumlahHariIni);
$totalHariIni = $dataJumlahHariIni['total'];

$jumlahSudahDiperiksa = mysqli_fetch_assoc(
  mysqli_query($conn, "SELECT COUNT(*) AS total FROM rekam_medis WHERE tgl_pemeriksaan = CURDATE() AND status_screening = 'Sudah Diperiksa'")
)['total'];

$jumlahBelumDiperiksa = mysqli_fetch_assoc(
  mysqli_query($conn, "SELECT COUNT(*) AS total FROM rekam_medis WHERE tgl_pemeriksaan = CURDATE() AND status_screening = 'Belum Diperiksa'")
)['total'];

// Ambil daftar ruang pelayanan
$queryRuang = mysqli_query($conn, "SELECT id_ruang, nama_ruang FROM ruang WHERE tipe_ruang = 'pelayanan'");
$jumlahPerRuang = [];
$namaRuang = [];
while ($ruang = mysqli_fetch_assoc($queryRuang)) {
  $id = $ruang['id_ruang'];
  $namaRuang[$id] = $ruang['nama_ruang'];
  $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM rekam_medis WHERE tgl_pemeriksaan = '$today' AND id_ruang = $id");
  $jumlahPerRuang[$id] = mysqli_fetch_assoc($result)['total'];
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <?php include '../link.php'; ?>
  <style>
    .chart-container {
      position: relative;
      max-width: 100%;
      height: 400px;
      margin-bottom: 40px;
    }

    canvas {
      max-height: 400px;
      width: 100%;
    }

    .card-stat {
      min-height: 100px;
      display: flex;
      align-items: center;
      justify-content: start;
      padding: 1rem;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
      gap: 1rem;
    }

    .card-stat:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
    }

    .card-stat .icon-wrapper {
      min-width: 50px;
      min-height: 50px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      color: #fff;
      flex-shrink: 0;
    }

    .card-stat h6 {
      font-weight: 500;
      margin: 0;
      font-size: 0.9rem;
      color: #666;
    }

    .card-stat h4 {
      font-weight: bold;
      margin: 0;
      font-size: 1.4rem;
      color: #000;
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
</head>

<body>
  <?php include '../header.php'; ?>
  <?php include '../siderbar.php'; ?>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard Petugas Screening</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active"><a href="index.php">Dashboard</a></li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">
        <!-- Card Box Statistik -->

        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card card-stat shadow-sm p-3">
            <div class="d-flex align-items-center">
              <div class="icon-wrapper bg-primary me-3">
                <i class="bi bi-calendar-event-fill"></i>
              </div>
              <div>
                <h6>Pendaftaran Hari Ini</h6>
                <h4><?= $totalHariIni ?></h4>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card card-stat shadow-sm p-3">
            <div class="d-flex align-items-center">
              <div class="icon-wrapper bg-success me-3">
                <i class="bi bi-check-circle-fill"></i>
              </div>
              <div>
                <h6>Sudah Diperiksa</h6>
                <h4><?= $jumlahSudahDiperiksa ?></h4>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card card-stat shadow-sm p-3">
            <div class="d-flex align-items-center">
              <div class="icon-wrapper bg-warning me-3">
                <i class="bi bi-clock-fill"></i>
              </div>
              <div>
                <h6>Belum Diperiksa</h6>
                <h4><?= $jumlahBelumDiperiksa ?></h4>
              </div>
            </div>
          </div>
        </div>

        <?php foreach ($jumlahPerRuang as $id => $jumlah): ?>
          <div class="col-xl-3 col-md-6 mb-4">
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

      <label for="year_filter">Pilih Tahun:</label>
      <select id="year_filter" onchange="loadCharts()" class="form-select d-inline-block w-auto"></select>
      <button onclick="resetYear()" class="btn btn-secondary">Refresh</button>

      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Grafik Jumlah Pasien Screening</h5>
            <div class="chart-container position-relative">
              <canvas id="screeningGenderChart"></canvas>
              <div id="screeningChartMsg" class="position-absolute top-50 start-50 translate-middle text-muted"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include '../footer.php'; ?>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="../assets/js/main.js"></script>

  <script>
    let charts = {};

    document.addEventListener('DOMContentLoaded', () => {
      populateYearOptions();
      loadCharts();
    });

    function populateYearOptions() {
      const currentYear = new Date().getFullYear();
      const yearSelect = document.getElementById('year_filter');
      yearSelect.innerHTML = "";
      for (let year = currentYear; year >= 2020; year--) {
        const option = document.createElement('option');
        option.value = year;
        option.textContent = year;
        yearSelect.appendChild(option);
      }
      yearSelect.value = currentYear;
    }

    function resetYear() {
      const currentYear = new Date().getFullYear();
      document.getElementById('year_filter').value = currentYear;
      loadCharts();
    }

    async function loadCharts() {
      document.getElementById('screeningChartMsg').innerText = 'Memuat data...';

      const selectedYear = document.getElementById('year_filter').value;

      try {
        const response = await fetch(`./api/grafik_screening.php?year=${selectedYear}`);
        const data = await response.json();

        renderLineChart('screeningGenderChart', data.screening.labels, data.screening.male_data, data.screening.female_data, 'screeningChartMsg');
      } catch (error) {
        document.getElementById('screeningChartMsg').innerText = 'Gagal memuat data.';
      }
    }

    function renderLineChart(canvasId, labels, maleData, femaleData, messageId) {
      const msgEl = document.getElementById(messageId);
      const ctx = document.getElementById(canvasId).getContext('2d');
      if (charts[canvasId]) charts[canvasId].destroy();

      if (labels.length === 0 || (maleData.every(v => v === 0) && femaleData.every(v => v === 0))) {
        msgEl.innerText = 'Tidak ada data.';
        return;
      } else {
        msgEl.innerText = '';
      }

      charts[canvasId] = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: [{
              label: 'Laki-laki',
              data: maleData,
              backgroundColor: 'rgba(54, 162, 235, 0.7)'
            },
            {
              label: 'Perempuan',
              data: femaleData,
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

    function renderPieChart(canvasId, labels, data, messageId) {
      const msgEl = document.getElementById(messageId);
      const ctx = document.getElementById(canvasId).getContext('2d');
      if (charts[canvasId]) charts[canvasId].destroy();

      const total = data.reduce((sum, val) => sum + val, 0);
      if (total === 0) {
        msgEl.innerText = 'Tidak ada data.';
        return;
      } else {
        msgEl.innerText = '';
      }

      charts[canvasId] = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: labels,
          datasets: [{
            data: data,
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0']
          }]
        },
        options: {
          responsive: true,
          plugins: {
            datalabels: {
              formatter: (value, context) => {
                let percentage = (value / total * 100).toFixed(1);
                return `${percentage}%`;
              },
              color: '#fff',
              font: {
                weight: 'bold'
              }
            },
            tooltip: {
              callbacks: {
                label: (context) => {
                  let val = context.raw;
                  let percent = ((val / total) * 100).toFixed(1);
                  return `${context.label}: ${val} (${percent}%)`;
                }
              }
            }
          }
        },
        plugins: [ChartDataLabels]
      });
    }
  </script>
</body>

</html>