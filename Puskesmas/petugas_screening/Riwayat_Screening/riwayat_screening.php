<?php
session_name("SCREENING_SESSION");
session_start();
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if ($_SESSION['role'] !== 'screening' || empty($_SESSION['screening_nip'])) {
    echo "<script> window.location = '../login/login-petugas.php' </script>";
    exit();
}

$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-d');
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d');
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
            <h1>Riwayat Screening Pasien</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Riwayat Screening</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body">
                    <form id="filterForm" method="GET" class="row g-3 pt-4 pb-2 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label">Dari Tanggal</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="<?= $start_date ?>" onchange="this.form.submit()">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sampai Tanggal</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="<?= $end_date ?>" onchange="this.form.submit()">
                        </div>
                        <div class="col-md-4 d-flex gap-2">
                            <button type="button" class="btn btn-secondary" onclick="resetDate()"><i class="bi bi-arrow-clockwise"></i> Reset</button>
                            <a href="cetak-riwayat-screening.php?start_date=<?= $start_date ?>&end_date=<?= $end_date ?>" target="_blank" class="btn btn-success">
                                <i class="bi bi-printer-fill"></i> Cetak Laporan
                            </a>
                        </div>
                    </form>

                    <div class="table-responsive mt-4">
                        <table class="table table-hover table-bordered table-striped hidden-until-ready" id="dataTable">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Pasien</th>
                                    <th>NIK</th>
                                    <th>Keluhan</th>
                                    <th>L/P</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tanggal1_safe = mysqli_real_escape_string($conn, $start_date);
                                $tanggal2_safe = mysqli_real_escape_string($conn, $end_date);
                                $query = "SELECT * FROM rekam_medis a LEFT JOIN pasien b ON a.nik_pasien = b.nik_pasien WHERE tgl_pemeriksaan BETWEEN '$tanggal1_safe' AND '$tanggal2_safe' ORDER BY id_rm DESC";
                                $result = mysqli_query($conn, $query);
                                $i = 1;
                                while ($data = mysqli_fetch_array($result)) {
                                    $badge = ($data['status_screening'] === 'Sudah Diperiksa') ? '<span class="badge bg-success">Sudah Diperiksa</span>' : '<span class="badge bg-danger">Belum Diperiksa</span>';
                                ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $data['tgl_pemeriksaan']; ?></td>
                                        <td><?= htmlspecialchars($data['nama_pasien']); ?></td>
                                        <td><?= $data['nik_pasien']; ?></td>
                                        <td><?= htmlspecialchars($data['sakit']); ?></td>
                                        <td><?= $data['jk_pasien']; ?></td>
                                        <td><?= $badge; ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm" href="detail-screening.php?id_rm=<?= $data['id_rm']; ?>">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php }
                                if (mysqli_num_rows($result) === 0) {
                                ?>
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-3">
                                            Tidak ada data screening pada rentang tanggal yang dipilih.
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
                    noRows: "Tidak ada data hasil screening.",
                    placeholder: "Cari...",
                    perPage: "Data per halaman",
                    noResults: "Tidak ditemukan hasil yang cocok",
                    info: "Menampilkan {start} sampai {end} dari total {rows} data"
                }
            });
        });

        function resetDate() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('start_date').value = today;
            document.getElementById('end_date').value = today;
            document.getElementById('filterForm').submit();
        }
    </script>
</body>

</html>