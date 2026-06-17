<?php
session_name("DOKTER_SESSION");
session_start();
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if ($_SESSION['role'] !== 'dokter' || empty($_SESSION['dokter_nip'])) {
  echo "<script> window.location = '../login/login-dokter.php' </script>";
  exit();
}

$nip_dokter = $_SESSION['dokter_nip'];
$id_ruang = $_SESSION['ruang_id'];
$today = date('Y-m-d');

$totalHariIni = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM rekam_medis WHERE tgl_pemeriksaan = '$today' AND id_ruang = $id_ruang"))['total'];
$jumlahSudahDiperiksa = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM rekam_medis WHERE tgl_pemeriksaan = '$today' AND status_dokter = 'Sudah Diperiksa' AND id_ruang = $id_ruang"))['total'];
$jumlahBelumDiperiksa = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM rekam_medis WHERE tgl_pemeriksaan = '$today' AND status_dokter = 'Belum Diperiksa' AND id_ruang = $id_ruang"))['total'];
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
      border-radius: 12px;
      box-shadow: 0 0 12px rgba(0, 0, 0, 0.05);
      transition: all 0.2s ease;
    }

    .card-stat:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
    }

    .icon-wrapper {
      width: 50px;
      height: 50px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      font-size: 1.4rem;
    }

    .no-data-label {
      text-align: center;
      margin-top: 2rem;
      font-style: italic;
      color: #888;
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <?php include '../header.php';
  include '../siderbar.php'; ?>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard Dokter</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active"><a href="index.php">Dashboard</a></li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card card-stat p-3">
            <div class="d-flex align-items-center">
              <div class="icon-wrapper bg-info me-3">
                <i class="bi bi-calendar-event-fill"></i>
              </div>
              <div>
                <h6>Pelayanan Hari Ini</h6>
                <h4><?= $totalHariIni ?></h4>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card card-stat p-3">
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
          <div class="card card-stat p-3">
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
      </div>
      <label for="selected_year">Pilih Tahun:</label>
      <select id="selected_year" class="form-select" style="width:auto; display:inline-block;" onchange="loadCharts()">
        <?php
        $currentYear = date('Y');
        for ($i = $currentYear; $i >= $currentYear - 5; $i--) {
          echo "<option value='$i'>$i</option>";
        }
        ?>
      </select>
      <button onclick="resetToCurrentYear()" class="btn btn-secondary ms-2">Refresh</button>
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Grafik Kunjungan Pasien</h5>
              <div class="chart-container">
                <canvas id="kunjunganPasienChart"></canvas>
                <div id="kunjunganEmptyMsg" class="no-data-label" style="display:none;">Tidak ada data kunjungan untuk tahun ini</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12 mt-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Top 10 Diagnosa Terbanyak</h5>
              <div class="chart-container">
                <canvas id="diagnosaChart"></canvas>
                <div id="diagnosaEmptyMsg" class="no-data-label" style="display:none;">Tidak ada data diagnosa untuk tahun ini</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <script>
    let charts = {};

    document.addEventListener('DOMContentLoaded', () => {
      document.getElementById('selected_year').value = new Date().getFullYear();
      loadCharts();
    });

    async function fetchChartData(chartType) {
      const selectedYear = document.getElementById('selected_year').value;
      const response = await fetch(`./api/chart_api.php?chart=${chartType}&year=${selectedYear}`);
      const data = await response.json();
      return data[chartType];
    }

    function renderChart(canvasId, labels, maleData, femaleData, chartType = 'bar') {
      const ctx = document.getElementById(canvasId).getContext('2d');
      if (charts[canvasId]) charts[canvasId].destroy();

      const totalData = [...maleData, ...femaleData].reduce((sum, val) => sum + val, 0);
      const emptyMsg = document.getElementById(canvasId === 'kunjunganPasienChart' ? 'kunjunganEmptyMsg' : '');

      if (totalData === 0) {
        emptyMsg.style.display = 'block';
        return;
      } else {
        emptyMsg.style.display = 'none';
      }

      charts[canvasId] = new Chart(ctx, {
        type: chartType,
        data: {
          labels: labels,
          datasets: [{
              label: 'Laki-Laki',
              data: maleData,
              backgroundColor: 'rgba(54, 162, 235, 0.7)',
            },
            {
              label: 'Perempuan',
              data: femaleData,
              backgroundColor: 'rgba(255, 99, 132, 0.7)',
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

    async function loadCharts() {
      const kunjunganData = await fetchChartData('kunjungan');
      renderChart('kunjunganPasienChart', kunjunganData.labels, kunjunganData.male_data, kunjunganData.female_data, 'bar');

      const diagnosaData = await fetchChartData('diagnosa');
      renderDiagnosaChart(diagnosaData.labels, diagnosaData.data);
    }

    function resetToCurrentYear() {
      document.getElementById('selected_year').value = new Date().getFullYear();
      loadCharts();
    }

    function renderDiagnosaChart(labels, data) {
      const ctx = document.getElementById('diagnosaChart').getContext('2d');
      if (charts['diagnosaChart']) charts['diagnosaChart'].destroy();

      const totalData = data.reduce((sum, val) => sum + val, 0);
      const emptyMsg = document.getElementById('diagnosaEmptyMsg');

      if (totalData === 0) {
        emptyMsg.style.display = 'block';
        return;
      } else {
        emptyMsg.style.display = 'none';
      }

      charts['diagnosaChart'] = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: [{
            label: 'Jumlah Diagnosa',
            data: data,
            backgroundColor: 'rgba(153, 102, 255, 0.7)'
          }]
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
  </script>

  <?php include '../footer.php'; ?>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/js/main.js"></script>
</body>

</html>