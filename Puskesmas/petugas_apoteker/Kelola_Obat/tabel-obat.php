<?php
session_name("APOTEKER_SESSION");
session_start();
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if ($_SESSION['role'] !== 'apoteker' || empty($_SESSION['apoteker_nip'])) {
  echo "<script> window.location = '../login/login-petugas.php' </script>";
  exit();
}

require 'function-obat.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <?php include '../link.php'; ?>
  <style>
    .hidden-until-ready {
      display: none;
    }
  </style>
</head>

<body>
  <?php
  include '../header.php';
  include '../siderbar.php';
  ?>
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Kelola Data Obat</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Kelola Data Obat</li>
        </ol>
      </nav>
    </div>
    <div class="card mb-4">
      <div class="card-header">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">
          <i class="fa fa-plus"> Tambah Data</i>
        </button>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalObatMasuk">
          <i class="bi bi-box-arrow-in-down"></i> Kelola Obat Masuk
        </button>
        <form method="GET" class="row g-3 mb-3 align-items-end">
          <div class="col-md-3">
            <label for="from_date">Dari Tanggal:</label>
            <input type="date" id="from_date" name="from_date" class="form-control"
              value="<?= $_GET['from_date'] ?? '' ?>" onchange="this.form.submit()">
          </div>
          <div class="col-md-3">
            <label for="to_date">Sampai Tanggal:</label>
            <input type="date" id="to_date" name="to_date" class="form-control"
              value="<?= $_GET['to_date'] ?? '' ?>" onchange="this.form.submit()">
          </div>
          <div class="col-md-3">
            <label for="filterLaporan">Jenis Laporan:</label>
            <select name="filterLaporan" id="filterLaporan" class="form-select" onchange="this.form.submit()">
              <option value="semua" <?= ($_GET['filterLaporan'] ?? '') == 'semua' ? 'selected' : '' ?>>Semua Obat</option>
              <option value="aman" <?= ($_GET['filterLaporan'] ?? '') == 'aman' ? 'selected' : '' ?>>Obat Aman</option>
              <option value="kadaluarsa" <?= ($_GET['filterLaporan'] ?? '') == 'kadaluarsa' ? 'selected' : '' ?>>Obat Kadaluarsa</option>
              <option value="stok_tipis" <?= ($_GET['filterLaporan'] ?? '') == 'stok_tipis' ? 'selected' : '' ?>>Stok Tipis (≤ minimum)</option>
            </select>
          </div>
          <div class="col-md-3 d-flex gap-6">
            <a href="tabel-obat.php" class="btn btn-secondary">
              <i class="bi bi-arrow-clockwise"></i> Refresh
            </a>
            <a href="laporan-html.php?filterLaporan=<?= $_GET['filterLaporan'] ?? 'semua' ?>&from_date=<?= $_GET['from_date'] ?? '' ?>&to_date=<?= $_GET['to_date'] ?? '' ?>"
              class="btn btn-success" target="_blank">
              <i class="bi bi-printer-fill"></i> Cetak Laporan
            </a>
          </div>
          <div class="col-12">
            <small class="text-muted fst-italic">
              Anda dapat menyaring data berdasarkan <strong>tanggal kadaluarsa</strong> dan <strong>jenis laporan</strong>. Pilihan akan langsung diterapkan.
            </small>
          </div>
        </form>
        <?php if (!empty($_GET['from_date']) && !empty($_GET['to_date'])): ?>
          <div class="alert alert-info mt-2 mb-0">
            Menampilkan data obat dengan kadaluarsa antara <strong><?= htmlspecialchars($_GET['from_date']) ?></strong>
            dan <strong><?= htmlspecialchars($_GET['to_date']) ?></strong>.
          </div>
        <?php endif; ?>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-bordered table-striped hidden-until-ready" id="dataTable">
            <thead class="table-primary">
              <tr>
                <th>No</th>
                <th>Kode Obat</th>
                <th>Nama Obat</th>
                <th>Dosis Obat</th>
                <th>Satuan</th>
                <th>Stok</th>
                <th>Min. Stok</th>
                <th>Kadaluarsa</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $where = [];
              if (!empty($_GET['from_date']) && !empty($_GET['to_date'])) {
                $from = mysqli_real_escape_string($conn, $_GET['from_date']);
                $to = mysqli_real_escape_string($conn, $_GET['to_date']);
                $where[] = "tgl_kadaluarsa BETWEEN '$from' AND '$to'";
              }

              $filter = $_GET['filterLaporan'] ?? 'semua';
              if ($filter === 'kadaluarsa') {
                $where[] = "tgl_kadaluarsa <= DATE_ADD(CURDATE(), INTERVAL 365 DAY)";
              } elseif ($filter === 'stok_tipis') {
                $where[] = "stok_obat <= minimum_stok";
              } elseif ($filter === 'aman') {
                // Obat dengan stok cukup, belum dan tidak akan kadaluarsa dalam 365 hari
                $where[] = "tgl_kadaluarsa > DATE_ADD(CURDATE(), INTERVAL 365 DAY) AND stok_obat > minimum_stok";
              }

              $whereClause = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : '';
              $ambilsemuahasil = mysqli_query($conn, "SELECT * FROM obat $whereClause");

              $i = 1;
              $modalAll = "";
              while ($data = mysqli_fetch_array($ambilsemuahasil)) {
                $ido = $data['kode_obat'];
                $nama_obat = $data['nama_obat'];
                $dosis_obat = $data['dosis_obat'];
                $satuan = $data['satuan'];
                $stok = $data['stok_obat'];
                $minimum_stok = $data['minimum_stok'];
                $tgl_kadaluarsa = $data['tgl_kadaluarsa'];
                $keterangan_obat = $data['keterangan_obat'];

                $is_expired = false;
                $is_akan_kadaluarsa = false;
                if (!empty($tgl_kadaluarsa)) {
                  $tgl_obj = DateTime::createFromFormat('Y-m-d', $tgl_kadaluarsa);
                  $today = new DateTime();
                  $in365 = (clone $today)->modify('+365 days');

                  if ($tgl_obj < $today) {
                    $is_expired = true;
                  } elseif ($tgl_obj >= $today && $tgl_obj <= $in365) {
                    $is_akan_kadaluarsa = true;
                  }
                }

                $display_stok = ($is_expired || $is_akan_kadaluarsa) ? 0 : $stok;

                $status_stok = "";
                if ($display_stok == 0) {
                  $status_stok = "<div><span class='badge bg-danger mt-1'>Stok Habis</span></div>";
                } elseif ($stok <= $minimum_stok) {
                  $status_stok = "<div><span class='badge bg-warning text-dark mt-1'>Stok Menipis</span></div>";
                }

                echo "<tr>
                  <td class='text-center'>{$i}</td>
                  <td>{$ido}</td>
                  <td>{$nama_obat}</td>
                  <td>{$dosis_obat}</td>
                  <td>{$satuan}</td>
                  <td class='text-center'>
                    {$display_stok}
                    {$status_stok}
                  </td>
                  <td class='text-center'>{$minimum_stok}</td>
                  <td class='text-center'>" . date('Y-m-d', strtotime($tgl_kadaluarsa));
                if ($is_expired) {
                  echo " <span class='badge bg-danger ms-1' title='Obat sudah lewat masa kadaluarsa'>Kadaluarsa</span>";
                } elseif ($is_akan_kadaluarsa) {
                  echo " <span class='badge bg-warning text-dark ms-1' title='Akan kadaluarsa dalam 365 hari'>Akan Kadaluarsa</span>";
                }
                echo "</td>
                  <td class='text-center'>
                    <div class='btn-group'>
                      <button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#keteranganobat{$ido}'><i class='bi bi-eye-fill'></i></button>
                      <button type='button' class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#updateobat{$ido}'><i class='bi bi-pencil-square'></i></button>
                      <button type='button' class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#riwayat{$ido}'><i class='bi bi-clock-history'></i></button>
                      <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#deleteobat{$ido}'><i class='bi bi-trash-fill'></i></button>
                    </div>
                  </td>
                </tr>";

                ob_start();
                include 'modal-riwayat.php';
                include 'update-obat.php';
                include 'delete-obat.php';
                include 'modal-keterangan.php';
                $modalAll .= ob_get_clean();
                $i++;
              }
              ?>
            </tbody>
          </table>
          <?= $modalAll ?>
        </div>
      </div>
    </div>
  </main>
  <?php include '../footer.php'; ?>
  <?php include 'tambah-obat.php'; ?>
  <?php include 'tambah-obat-masuk.php'; ?>

  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/js/main.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const tableEl = document.querySelector("#dataTable");
      tableEl.classList.remove("hidden-until-ready");

      const dataTable = new simpleDatatables.DataTable(tableEl, {
        labels: {
          noRows: "Tidak ada data obat yang ditemukan.",
          placeholder: "Cari...",
          perPage: "Data per halaman",
          noResults: "Tidak ditemukan hasil yang cocok",
          info: "Menampilkan {start} sampai {end} dari total {rows} data"
        }
      });

      dataTable.on("datatable.init", function() {
        tableEl.style.display = "table";
      });

      function warnaiKadaluarsa() {
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        const rows = document.querySelectorAll("#dataTable tbody tr");
        rows.forEach(row => {
          const cell = row.cells[8];
          if (!cell) return;

          const tglText = cell.textContent.trim().slice(0, 10);
          if (!tglText || isNaN(Date.parse(tglText))) return;

          const tglObat = new Date(tglText);
          tglObat.setHours(0, 0, 0, 0);

          if (tglObat < today) {
            row.classList.add("table-danger");
          } else {
            row.classList.remove("table-danger");
          }
        });
      }

      dataTable.on("datatable.init", warnaiKadaluarsa);
      dataTable.on("datatable.page", warnaiKadaluarsa);
      dataTable.on("datatable.search", warnaiKadaluarsa);
      dataTable.on("datatable.sort", warnaiKadaluarsa);
    });
  </script>
</body>

</html>