<?php
session_name("DOKTER_SESSION");
session_start();
include '../../koneksi.php';
if ($_SESSION['role'] !== 'dokter' || empty($_SESSION['dokter_nip'])) {
    echo "<script> window.location = '../login/login-dokter.php' </script>";
    exit();
}

$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-d');
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <?php include '../link.php'; ?>
    <title>Laporan Hasil Pemeriksaan - Dokter</title>
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
            <h1>Laporan Hasil Pemeriksaan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Laporan</li>
                </ol>
            </nav>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="card-header">
                    <form id="filterForm" method="GET" class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label for="start_date">Dari Tanggal:</label>
                            <input type="date" id="start_date" name="start_date" class="form-control" value="<?= $start_date ?>" onchange="this.form.submit()">
                        </div>
                        <div class="col-md-4">
                            <label for="end_date">Sampai Tanggal:</label>
                            <input type="date" id="end_date" name="end_date" class="form-control" value="<?= $end_date ?>" onchange="this.form.submit()">
                        </div>
                        <div class="col-md-4 d-flex gap-2">
                            <button type="button" class="btn btn-secondary" onclick="resetDate()"><i class="bi bi-arrow-clockwise"></i> Reset</button>
                            <a href="cetak-laporan.php?start_date=<?= $start_date ?>&end_date=<?= $end_date ?>" target="_blank" class="btn btn-success">
                                <i class="bi bi-printer-fill"></i> Cetak Laporan
                            </a>
                        </div>
                        <div class="col-12">
                            <small class="text-muted fst-italic">
                                Riwayat pemeriksaan berdasarkan <strong>rentang tanggal</strong> yang dipilih.
                            </small>
                        </div>
                    </form>
                </div>

                <div class="table-responsive mt-3">
                    <table class="table table-hover table-bordered table-striped hidden-until-ready" id="dataTable">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Pasien</th>
                                <th>Umur</th>
                                <th>Keluhan</th>
                                <th>Keterangan</th>
                                <th>ICD 10</th>
                                <th>Nama Penyakit</th>
                                <th>Dokter</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nip = $_SESSION['dokter_nip'];
                            $query = "
                                SELECT rm.*, p.nama_pasien, rm.umur, rm.sakit, rm.keterangan_hasil,
                                       rm.ICD_10, rm.nama_penyakit, d.nama_dokter, rm.tgl_pemeriksaan
                                FROM rekam_medis rm
                                JOIN pasien p ON rm.nik_pasien = p.nik_pasien
                                JOIN dokter d ON rm.nip_dokter = d.nip_dokter
                                WHERE rm.nip_dokter = '$nip' 
                                AND DATE(rm.tgl_pemeriksaan) BETWEEN '$start_date' AND '$end_date'
                                ORDER BY rm.tgl_pemeriksaan DESC
                            ";
                            $hasil = mysqli_query($conn, $query);
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($hasil)) {
                                $badge = ($row['status_dokter'] === 'Sudah Diperiksa')
                                    ? '<span class="badge bg-success">Sudah Diperiksa</span>'
                                    : '<span class="badge bg-danger">Belum Diperiksa</span>';
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td class="text-center"><?= date('d-m-Y', strtotime($row['tgl_pemeriksaan'])) ?></td>
                                    <td><?= htmlspecialchars($row['nama_pasien']) ?></td>
                                    <td class="text-center"><?= $row['umur'] ?></td>
                                    <td><?= htmlspecialchars($row['sakit']) ?></td>
                                    <td><?= htmlspecialchars($row['keterangan_hasil']) ?></td>
                                    <td class="text-center"><?= $row['ICD_10'] ?></td>
                                    <td><?= htmlspecialchars($row['nama_penyakit']) ?></td>
                                    <td><?= htmlspecialchars($row['nama_dokter']) ?></td>
                                    <td class="text-center"><?= $badge; ?></td>
                                </tr>
                            <?php } ?>
                            <?php if (mysqli_num_rows($hasil) === 0) { ?>
                                <tr>
                                    <td colspan="10" class="text-center text-muted py-3">
                                        Tidak ada data hasil pemeriksaan pada rentang tanggal yang dipilih.
                                    </td>
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

        function resetDate() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('start_date').value = today;
            document.getElementById('end_date').value = today;
            document.getElementById('filterForm').submit();
        }
    </script>
</body>

</html>