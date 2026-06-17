<?php
session_name("APOTEKER_SESSION");
session_start();
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

// Cek apakah sudah login sebagai apoteker
if ($_SESSION['role'] !== 'apoteker' || empty($_SESSION['apoteker_nip'])) {
  echo "<script> window.location = '../login/login-petugas.php' </script>";
  exit();
}

// Validasi apakah ruang apoteker
if ($_SESSION['ruang_id'] != 6) {
  echo "<script> window.location = '../login/login-petugas.php' </script>";
  exit();
}

// Inisialisasi notifikasi
$notifikasi = [];

// Notif Obat Kadaluarsa
$q_kadaluarsa = mysqli_query($conn, "SELECT COUNT(*) AS total FROM obat WHERE tgl_kadaluarsa < CURDATE()");
$r_kadaluarsa = mysqli_fetch_assoc($q_kadaluarsa);
if ($r_kadaluarsa['total'] > 0) {
  $notifikasi[] = "⚠️ <strong>{$r_kadaluarsa['total']}</strong> obat sudah <strong>kadaluarsa</strong>.";
}

// Notif Obat Stok Menipis
$q_stok_tipis = mysqli_query($conn, "SELECT COUNT(*) AS total FROM obat WHERE stok_obat <= minimum_stok");
$r_stok_tipis = mysqli_fetch_assoc($q_stok_tipis);
if ($r_stok_tipis['total'] > 0) {
  $notifikasi[] = "⚠️ <strong>{$r_stok_tipis['total']}</strong> obat memiliki <strong>stok menipis</strong>.";
}

// Notif Obat Akan Kadaluarsa dalam 30 hari
$q_akan_kadaluarsa = mysqli_query($conn, "
  SELECT COUNT(*) AS total 
  FROM obat 
  WHERE tgl_kadaluarsa BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)
");
$r_akan_kadaluarsa = mysqli_fetch_assoc($q_akan_kadaluarsa);
if ($r_akan_kadaluarsa['total'] > 0) {
  $notifikasi[] = "🔔 <strong>{$r_akan_kadaluarsa['total']}</strong> obat akan <strong>kadaluarsa</strong>.";
}

$selectedYear = date('Y');
if (isset($_GET['year']) && is_numeric($_GET['year'])) {
  $selectedYear = $_GET['year'];
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
      height: 400px !important;
      width: 100% !important;
    }

    canvas {
      max-height: 400px !important;
      width: 100% !important;
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <?php include '../header.php'; ?>
  <?php include '../siderbar.php'; ?>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard Petugas Apoteker</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active"><a href="index.php">Dashboard</a></li>
        </ol>
      </nav>

      <?php if (!empty($notifikasi)): ?>
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
          <h5 class="alert-heading">Notifikasi Obat:</h5>
          <ul class="mb-0">
            <?php foreach ($notifikasi as $notif): ?>
              <li><?= $notif ?></li>
            <?php endforeach; ?>
          </ul>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
    </div>

    <form method="GET" class="d-inline-block mb-3">
      <label for="select_year">Pilih Tahun:</label>
      <select id="select_year" name="year" class="form-select d-inline-block" style="width:auto;" onchange="this.form.submit()">
        <?php
        for ($i = date('Y'); $i >= date('Y') - 5; $i--) {
          $selected = ($i == $selectedYear) ? 'selected' : '';
          echo "<option value='$i' $selected>$i</option>";
        }
        ?>
      </select>
    </form>

    <section class="section dashboard">
      <div class="row" id="statistik-cards">
        <div class="col-lg-3 col-md-6">
          <div class="card info-card">
            <div class="card-body">
              <h5 class="card-title">Total Obat</h5>
              <div class="ps-3">
                <h6 id="total-obat">...</h6><span class="text-muted small pt-2">Semua data obat</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="card info-card">
            <div class="card-body">
              <h5 class="card-title">Jenis Obat</h5>
              <div class="ps-3">
                <h6 id="total-jenis">...</h6><span class="text-muted small pt-2">Obat berbeda</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="card info-card">
            <div class="card-body">
              <h5 class="card-title">Stok Tersedia</h5>
              <div class="ps-3">
                <h6 id="stok-tersedia">...</h6><span class="text-muted small pt-2">Unit tersedia</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="card info-card">
            <div class="card-body">
              <h5 class="card-title">Resep Didistribusi (<?= $selectedYear ?>)</h5>
              <div class="ps-3">
                <h6 id="total-resep">...</h6><span class="text-muted small pt-2">Dalam tahun ini</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="card info-card">
            <div class="card-body">
              <h5 class="card-title">Distribusi Hari Ini</h5>
              <div class="ps-3">
                <h6 id="distribusi-hari-ini">...</h6><span class="text-muted small pt-2">Tanggal <?= date('d-m-Y') ?></span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Grafik Statistik Obat</h5>
              <div class="chart-container">
                <canvas id="obatChart"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <script>
    const selectedYear = <?= json_encode($selectedYear) ?>;
    let charts = {};

    document.addEventListener('DOMContentLoaded', () => {
      loadStatistik(selectedYear);
      loadCharts(selectedYear);
    });

    async function loadStatistik(year) {
      try {
        const res = await fetch(`./api/statistik_api.php?tahun=${year}`);
        const data = await res.json();
        if (data.error) throw new Error(data.error);

        document.getElementById('total-obat').innerText = data.total_obat;
        document.getElementById('total-jenis').innerText = data.total_jenis;
        document.getElementById('stok-tersedia').innerText = data.stok_tersedia;
        document.getElementById('total-resep').innerText = data.total_resep;
        document.getElementById('distribusi-hari-ini').innerText = data.distribusi_hari_ini;
      } catch (err) {
        console.error("Gagal memuat statistik:", err);
      }
    }

    async function fetchChartData(chartType, selectedYear) {
      const startDate = `${selectedYear}-01-01`;
      const endDate = `${selectedYear}-12-31`;
      const response = await fetch(`./api/chart_api.php?chart=${chartType}&start_date=${startDate}&end_date=${endDate}`);
      const data = await response.json();
      return data[chartType];
    }

    function renderChart(canvasId, type, labels, data) {
      const ctx = document.getElementById(canvasId).getContext('2d');
      if (charts[canvasId]) charts[canvasId].destroy();

      charts[canvasId] = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: [{
              label: 'Jumlah Obat yang Dikirim',
              data: data.dikirim,
              backgroundColor: 'rgba(0, 122, 255, 0.8)'
            },
            {
              label: 'Jumlah Obat yang Masuk',
              data: data.masuk,
              backgroundColor: 'rgba(52, 199, 89, 0.8)'
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: true,
          plugins: {
            tooltip: {
              callbacks: {
                label: function(context) {
                  return `${context.dataset.label}: ${context.raw} item`;
                }
              }
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              suggestedMax: Math.max(...data.dikirim, ...data.masuk) + 2
            }
          }
        }
      });
    }

    async function loadCharts(year) {
      const obatData = await fetchChartData('obat', year);
      renderChart('obatChart', 'bar', obatData.labels, obatData);
    }
  </script>

  <?php include '../footer.php'; ?>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/main.js"></script>
</body>

</html>