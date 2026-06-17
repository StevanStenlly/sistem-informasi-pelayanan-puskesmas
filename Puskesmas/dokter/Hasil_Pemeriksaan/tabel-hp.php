<?php
session_name("DOKTER_SESSION");
session_start();
include "../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if ($_SESSION['role'] !== 'dokter' || empty($_SESSION['dokter_nip'])) {
  echo "<script> window.location = '../login/login-dokter.php' </script>";
  exit();
}

require 'function-hp.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <?php include '../link.php'; ?>
  <style>
    .hidden-until-ready {
      visibility: hidden;
    }
  </style>
</head>

<body>
  <?php include '../header.php';
  include '../siderbar.php'; ?>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Kelola Hasil Pemeriksaan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Kelola Hasil Pemeriksaan</li>
        </ol>
      </nav>
    </div>

    <section class="section profile">
      <div class="row">
        <div class="col-xl">
          <div class="card">
            <div class="card-body pt-3">
              <div class="tab-content pt-2">
                <?php
                $id_ru = $_SESSION['ruang_id'];
                $ambilruang = mysqli_query($conn, "SELECT b.nama_ruang FROM dokter a LEFT JOIN ruang b ON a.id_ruang = b.id_ruang WHERE a.id_ruang = '$id_ru' LIMIT 1");
                $nama_ruang = mysqli_fetch_assoc($ambilruang)['nama_ruang'];
                ?>

                <h5 class="card-title"><?= $nama_ruang; ?></h5>


                <div class="card mb-4">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-hover table-bordered table-striped hidden-until-ready" id="dataTable">
                        <thead class="table-primary">
                          <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Rekam Medis</th>
                            <th>Nama Pasien</th>
                            <th>NIK Pasien</th>
                            <th>Umur</th>
                            <th>L/P</th>
                            <th>Status</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $id_ru = $_SESSION['ruang_id'];
                          date_default_timezone_set('Asia/Jakarta');
                          $today = date('Y-m-d');
                          $query = "SELECT * FROM rekam_medis a 
                                    LEFT JOIN ruang c ON a.id_ruang=c.id_ruang 
                                    LEFT JOIN pasien d ON a.nik_pasien=d.nik_pasien 
                                    LEFT JOIN dokter e ON a.nip_dokter=e.nip_dokter 
                                    WHERE a.id_ruang = '$id_ru' AND tgl_pemeriksaan = '$today' ORDER BY id_rm DESC";
                          $hasil = mysqli_query($conn, $query);
                          $i = 1;
                          while ($data = mysqli_fetch_array($hasil)) {
                            $badge = ($data['status_dokter'] === 'Sudah Diperiksa')
                              ? '<span class="badge bg-success">Sudah Diperiksa</span>'
                              : '<span class="badge bg-danger">Belum Diperiksa</span>';
                          ?>
                            <tr>
                              <td><?= $i++; ?></td>
                              <td><?= $data['tgl_pemeriksaan']; ?></td>
                              <td>K-<?= $data['rm']; ?></td>
                              <td><?= htmlspecialchars($data['nama_pasien']); ?></td>
                              <td><?= $data['nik_pasien']; ?></td>
                              <td><?= $data['umur']; ?></td>
                              <td><?= $data['jk_pasien']; ?></td>
                              <td><?= $badge; ?></td>
                              <td class="text-center">
                                <a type="button" class="btn btn-primary btn-sm" href="detail-hp.php?id_rm=<?= $data['id_rm']; ?>">
                                  <i class="bi bi-pencil-square"></i>
                                </a>
                              </td>
                            </tr>
                            <?php include 'update-hp.php';
                            include 'delete-hp.php'; ?>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
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
      tableEl.style.visibility = "visible";

      const dataTable = new simpleDatatables.DataTable(tableEl, {
        labels: {
          noRows: "Tidak ada data hasil pemeriksaan.",
          placeholder: "Cari...",
          perPage: "Data per halaman",
          noResults: "Tidak ditemukan hasil yang cocok",
          info: "Menampilkan {start} sampai {end} dari total {rows} data"
        }
      });
    });
  </script>
</body>

<?php include 'tambah-hp.php'; ?>

</html>