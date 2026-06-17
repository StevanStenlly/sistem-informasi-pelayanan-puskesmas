<?php
session_name("PASIEN_SESSION");
session_start();
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if ($_SESSION['role'] !== 'pasien' || empty($_SESSION['pasien_nik'])) {
  echo "<script> window.location = '../login/login-pasien.php' </script>";
  exit();
}

require 'function-pelayanan.php';

// Proses pembatalan jika ada request POST dengan id_rm
if (isset($_POST['batalkan']) && isset($_POST['id_rm'])) {
  $id_rm = intval($_POST['id_rm']);
  $cekStatus = mysqli_query($conn, "SELECT status_dokter FROM rekam_medis WHERE id_rm='$id_rm' AND nik_pasien='" . $_SESSION['pasien_nik'] . "'");
  $dataStatus = mysqli_fetch_assoc($cekStatus);

  if ($dataStatus && $dataStatus['status_dokter'] === 'Belum Diperiksa') {
    mysqli_query($conn, "DELETE FROM rekam_medis WHERE id_rm='$id_rm'");
    echo "<script>alert('Jadwal berhasil dibatalkan'); location.href='pelayanan_kesehatan.php';</script>";
    exit();
  }
}
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
      <h1>Pelayanan Kesehatan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Pelayanan Kesehatan</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="card mb-4">
        <div class="card-body">
          <?php
          $nik_pas = $_SESSION['pasien_nik'];
          $alamat = mysqli_query($conn, "SELECT * FROM pasien WHERE nik_pasien='$nik_pas'");
          $data = mysqli_fetch_array($alamat);
          $alamat_pasien = $data['alamat_pasien'];
          if (!empty($alamat_pasien)) {
            if (date('w') == 0) { // Hari Minggu = 0
              echo "<div class='alert alert-danger mb-3'><i class='bi bi-exclamation-circle'></i> Pendaftaran pelayanan tidak tersedia pada hari Minggu.</div>";
            } else {
              echo "<button type='button' class='btn btn-primary mb-3' data-bs-toggle='modal' data-bs-target='#ExtralargeModal'>
                <i class='bi bi-plus-circle'></i> Tambah Data
              </button>";
            }
          } else {
            echo "<div class='alert alert-warning'>Lengkapi Profil Terlebih Dahulu</div>";
          }

          ?>

          <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped hidden-until-ready" id="dataTable">
              <thead class="table-primary text-center">
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Keluhan</th>
                  <th>Resep Obat</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $ambilsemuahasil = mysqli_query(
                  $conn,
                  "SELECT * FROM rekam_medis a 
                   LEFT JOIN pasien b ON a.nik_pasien=b.nik_pasien 
                   WHERE a.nik_pasien='$nik_pas' 
                   ORDER BY tgl_pemeriksaan DESC"
                );
                $i = 1;
                while ($data = mysqli_fetch_array($ambilsemuahasil)) {
                  $id_rm = $data['id_rm'];
                  $tgl_pemeriksaan = $data['tgl_pemeriksaan'];
                  $sakit = $data['sakit'];
                  $status_dokter = $data['status_dokter'];

                  $badge = ($status_dokter === 'Sudah Diperiksa') ? '<span class="badge bg-success">Selesai</span>' : '<span class="badge bg-warning text-dark">Belum Diperiksa</span>';

                  $queryResep = "
                    SELECT o.nama_obat, r.dosis, r.jumlah 
                    FROM resep_obat r 
                    JOIN obat o ON r.kode_obat = o.kode_obat 
                    WHERE r.id_rm = '$id_rm'";
                  $resultResep = mysqli_query($conn, $queryResep);

                  $resep_obat = '';
                  while ($resep = mysqli_fetch_assoc($resultResep)) {
                    $resep_obat .= $resep['nama_obat'] . " (" . $resep['dosis'] . ", " . $resep['jumlah'] . ")<br>";
                  }

                  if (empty($resep_obat)) {
                    $resep_obat = '<span class="text-muted fst-italic">Tidak ada resep</span>';
                  }
                ?>
                  <tr>
                    <td class="text-center"><?= $i++; ?></td>
                    <td><?= $tgl_pemeriksaan; ?></td>
                    <td><?= htmlspecialchars($sakit); ?></td>
                    <td><?= $resep_obat; ?></td>
                    <td class="text-center"><?= $badge; ?></td>
                    <td class="text-center">
                      <?php if ($status_dokter === 'Belum Diperiksa') : ?>
                        <form method="POST" onsubmit="return confirm('Yakin ingin membatalkan jadwal ini?')">
                          <input type="hidden" name="id_rm" value="<?= $id_rm; ?>">
                          <button type="submit" name="batalkan" class="btn btn-danger btn-sm">
                            <i class="bi bi-x-circle"></i> Batalkan
                          </button>
                        </form>
                      <?php else : ?>
                        <span class="text-muted">-</span>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
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
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const tableEl = document.querySelector("#dataTable");
      tableEl.classList.remove("hidden-until-ready");
      tableEl.style.visibility = "visible";

      new simpleDatatables.DataTable(tableEl, {
        labels: {
          noRows: "Tidak ada data pelayanan.",
          placeholder: "Cari...",
          perPage: "Data per halaman",
          noResults: "Tidak ditemukan hasil yang cocok",
          info: "Menampilkan {start} sampai {end} dari total {rows} data"
        }
      });
    });
  </script>

</body>

<?php include 'tambah.php'; ?>

</html>