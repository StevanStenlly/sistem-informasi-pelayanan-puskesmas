<?php
session_name("ADMIN_SESSION");
session_start();
include '../../koneksi.php';

if ($_SESSION['role'] !== 'admin' || empty($_SESSION['admin_id'])) {
    echo "<script> window.location = '../login/login-admin.php' </script>";
    exit();
}

$from_date = $_GET['from_date'] ?? '';
$to_date = $_GET['to_date'] ?? '';
$whereClause = '';

if (!empty($from_date) && !empty($to_date)) {
    $from = mysqli_real_escape_string($conn, $from_date);
    $to = mysqli_real_escape_string($conn, $to_date);
    $whereClause = "WHERE rm.tgl_pemeriksaan BETWEEN '$from' AND '$to'";
} else {
    $today = date('Y-m-d');
    $whereClause = "WHERE DATE(rm.tgl_pemeriksaan) = '$today'";
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <?php include '../link.php'; ?>
    <title>Laporan Kunjungan Pasien</title>
    <style>
        .hidden-until-ready {
            visibility: hidden;
        }

        .form-label {
            font-weight: 500;
            color: #555;
        }

        .btn {
            white-space: nowrap;
        }
    </style>
</head>

<body>
    <?php include '../header.php';
    include '../siderbar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Laporan Kunjungan Pasien</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Laporan Kunjungan</li>
                </ol>
            </nav>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="card-header">
                    <form method="GET" class="row g-3 mb-3 align-items-end">
                        <div class="col">
                            <label for="from_date" class="form-label mb-0">Dari Tanggal:</label>
                            <input type="date" name="from_date" id="from_date" class="form-control" value="<?= $from_date ?>" onchange="this.form.submit()">
                        </div>
                        <div class="col">
                            <label for="to_date" class="form-label mb-0">Sampai Tanggal:</label>
                            <input type="date" name="to_date" id="to_date" class="form-control" value="<?= $to_date ?>" onchange="this.form.submit()">
                        </div>
                        <div class="col d-flex gap-2 align-items-end">
                            <a href="laporan.php" class="btn btn-secondary">
                                <i class="bi bi-arrow-clockwise"></i> Refresh
                            </a>
                            <a href="cetak-laporan.php?from_date=<?= $from_date ?>&to_date=<?= $to_date ?>" class="btn btn-success" target="_blank">
                                <i class="bi bi-printer-fill"></i> Cetak Laporan
                            </a>
                        </div>
                        <div class="col-12">
                            <small class="text-muted fst-italic">
                                Laporan kunjungan berdasarkan <strong>tanggal pemeriksaan</strong> pasien.
                            </small>
                        </div>
                    </form>
                </div>

                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-striped hidden-until-ready" id="dataTable">
                        <thead class="table-primary">
                            <tr>
                                <th>Pasien</th>
                                <th>ICD-10</th>
                                <th>Diagnosa</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Dokter</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "
                            SELECT p.nama_pasien, rm.ICD_10, rm.nama_penyakit, rm.tgl_pemeriksaan, rm.waktu_pemeriksaan,
                                   d.nama_dokter, rm.status_dokter
                            FROM rekam_medis rm
                            JOIN pasien p ON rm.nik_pasien = p.nik_pasien
                            LEFT JOIN dokter d ON rm.nip_dokter = d.nip_dokter
                            $whereClause
                            ORDER BY rm.tgl_pemeriksaan DESC, rm.waktu_pemeriksaan DESC
                        ";
                            $hasil = mysqli_query($conn, $query);
                            while ($data = mysqli_fetch_array($hasil)) {
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($data['nama_pasien']) ?></td>
                                    <td><?= htmlspecialchars($data['ICD_10']) ?></td>
                                    <td><?= htmlspecialchars($data['nama_penyakit']) ?></td>
                                    <td class="text-center"><?= date('d-m-Y', strtotime($data['tgl_pemeriksaan'])) ?></td>
                                    <td class="text-center"><?= date('H:i', strtotime($data['waktu_pemeriksaan'])) ?></td>
                                    <td><?= htmlspecialchars($data['nama_dokter'] ?? '-') ?></td>
                                    <td class="text-center"><?= htmlspecialchars($data['status_dokter']) ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <?php include '../footer.php'; ?>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/js/main.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tableEl = document.querySelector("#dataTable");
            tableEl.classList.remove("hidden-until-ready");
            tableEl.style.visibility = "visible";

            new simpleDatatables.DataTable(tableEl, {
                labels: {
                    noRows: "Tidak ada data kunjungan ditemukan.",
                    placeholder: "Cari...",
                    perPage: "Data per halaman",
                    noResults: "Tidak ditemukan hasil yang cocok",
                    info: "Menampilkan {start} sampai {end} dari total {rows} data"
                }
            });
        });
    </script>
</body>

</html>