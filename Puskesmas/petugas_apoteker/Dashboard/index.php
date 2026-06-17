<?php
session_name("APOTEKER_SESSION");
session_start();
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

// Cek apakah sudah login sebagai apoteker
if ($_SESSION['role'] !== 'apoteker' || empty($_SESSION['apoteker_nip']) || $_SESSION['ruang_id'] != 6) {
  echo "<script> window.location = '../login/login-petugas.php' </script>";
  exit();
}

// Inisialisasi notifikasi
$notifikasi = [];

// Notifikasi Obat Kadaluarsa
$q_kadaluarsa = mysqli_query($conn, "SELECT COUNT(*) AS total FROM obat WHERE tgl_kadaluarsa < CURDATE()");
$r_kadaluarsa = mysqli_fetch_assoc($q_kadaluarsa);
if ($r_kadaluarsa['total'] > 0) {
  $notifikasi[] = "⚠️ <strong>{$r_kadaluarsa['total']}</strong> obat sudah <strong>kadaluarsa</strong>.";
}

// Notifikasi Obat Stok Menipis
$q_stok_tipis = mysqli_query($conn, "SELECT COUNT(*) AS total FROM obat WHERE stok_obat <= minimum_stok");
$r_stok_tipis = mysqli_fetch_assoc($q_stok_tipis);
if ($r_stok_tipis['total'] > 0) {
  $notifikasi[] = "⚠️ <strong>{$r_stok_tipis['total']}</strong> obat memiliki <strong>stok menipis</strong>.";
}

// Notifikasi Obat Akan Kadaluarsa 30 Hari Lagi
$q_akan_kadaluarsa = mysqli_query($conn, "
  SELECT COUNT(*) AS total 
  FROM obat 
  WHERE tgl_kadaluarsa BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)
");
$r_akan_kadaluarsa = mysqli_fetch_assoc($q_akan_kadaluarsa);
if ($r_akan_kadaluarsa['total'] > 0) {
  $notifikasi[] = "🔔 <strong>{$r_akan_kadaluarsa['total']}</strong> obat akan <strong>kadaluarsa</strong>.";
}

// Statistik Per Tahun
$selectedYear = date('Y');
if (isset($_GET['year']) && is_numeric($_GET['year'])) {
  $selectedYear = $_GET['year'];
}

$q_total_obat = mysqli_query($conn, "SELECT COUNT(*) AS total FROM obat");
$r_total_obat = mysqli_fetch_assoc($q_total_obat)['total'];

$q_jenis_obat = mysqli_query($conn, "SELECT COUNT(DISTINCT nama_obat) AS total FROM obat");
$r_jenis_obat = mysqli_fetch_assoc($q_jenis_obat)['total'];

$q_stok_tersedia = mysqli_query($conn, "SELECT SUM(stok_obat) AS total FROM obat WHERE stok_obat > 0");
$r_stok_tersedia = mysqli_fetch_assoc($q_stok_tersedia)['total'];

$q_resep_didistribusi = mysqli_query($conn, "
  SELECT COUNT(DISTINCT id_resep) AS total 
  FROM distribusi_obat 
  WHERE YEAR(tgl_distribusi) = '$selectedYear'
");
$r_resep_didistribusi = mysqli_fetch_assoc($q_resep_didistribusi)['total'];

$q_hari_ini = mysqli_query($conn, "
  SELECT COUNT(*) AS total 
  FROM distribusi_obat 
  WHERE DATE(tgl_distribusi) = CURDATE()
");
$r_hari_ini = mysqli_fetch_assoc($q_hari_ini)['total'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <?php include '../link.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    .chart-container {
      position: relative;
      max-width: 100%;
      height: 400px;
    }

    canvas {
      max-height: 400px;
      width: 100%;
    }
  </style>
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

    <form method="GET" class="d-inline-block">
      <label for="select_year">Pilih Tahun:</label>
      <select id="select_year" name="year" class="form-select d-inline-block" style="width:auto;" onchange="this.form.submit()">
        <?php
        for ($i = date('Y'); $i >= date('Y') - 5; $i--) {
          $selected = ($i == $selectedYear) ? 'selected' : '';
          echo "<option value='$i' $selected>$i</option>";
        }
        ?>
      </select>
      <noscript><button type="submit" class="btn btn-secondary ms-2">Terapkan</button></noscript>
    </form>

    <section class="section dashboard mt-4">
      <div class="row">
        <?php
        $cards = [
          ['Total Obat', $r_total_obat, 'Semua data obat'],
          ['Jenis Obat', $r_jenis_obat, 'Obat berbeda'],
          ['Stok Tersedia', $r_stok_tersedia, 'Unit tersedia'],
          ["Resep Didistribusi ($selectedYear)", $r_resep_didistribusi, 'Dalam tahun ini'],
          ['Distribusi Hari Ini', $r_hari_ini, 'Tanggal ' . date('d-m-Y')]
        ];

        foreach ($cards as $card) {
          echo "
          <div class='col-lg-3 col-md-6'>
            <div class='card info-card'>
              <div class='card-body'>
                <h5 class='card-title'>{$card[0]}</h5>
                <div class='d-flex align-items-center'>
                  <div class='ps-3'>
                    <h6>{$card[1]}</h6>
                    <span class='text-muted small pt-2'>{$card[2]}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>";
        }
        ?>
      </div>

      <div class="row mt-4">
        <div class="col-12">
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
    const charts = {};

    async function fetchChartData(chartType, year) {
      const res = await fetch(`./api/chart_api.php?chart=${chartType}&start_date=${year}-01-01&end_date=${year}-12-31`);
      const data = await res.json();
      return data[chartType];
    }

    function renderChart(canvasId, labels, dataset1, dataset2) {
      const ctx = document.getElementById(canvasId).getContext('2d');
      if (charts[canvasId]) charts[canvasId].destroy();

      charts[canvasId] = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: [{
              label: 'Jumlah Obat yang Keluar',
              data: dataset1,
              backgroundColor: 'rgba(0, 122, 255, 0.8)'
            },
            {
              label: 'Jumlah Obat yang Masuk',
              data: dataset2,
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
                  return `${ctx.dataset.label}: ${ctx.raw} item`;
                }
              }
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              suggestedMax: Math.max(...dataset1, ...dataset2) + 2,
            }
          }
        }
      });
    }

    async function loadChart() {
      const selectedYear = document.getElementById('select_year').value;
      const data = await fetchChartData('obat', selectedYear);
      renderChart('obatChart', data.labels, data.dikirim, data.masuk);
    }

    document.addEventListener('DOMContentLoaded', loadChart);
    document.getElementById('select_year').addEventListener('change', loadChart);
  </script>

  <?php include '../footer.php'; ?>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/main.js"></script>
</body>

</html>