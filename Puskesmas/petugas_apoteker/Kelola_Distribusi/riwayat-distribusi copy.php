<?php
session_name("APOTEKER_SESSION");
session_start();
include '../../koneksi.php';
// ✅ Cek apakah sudah login sebagai apoteker
if ($_SESSION['role'] !== 'apoteker' || empty($_SESSION['apoteker_nip'])) {
    echo "<script> window.location = '../login/login-petugas.php' </script>";
    exit();
}

$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../link.php'; ?>
    <title>Riwayat Distribusi Obat</title>
</head>

<body>
    <?php include '../header.php';
    include '../siderbar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Riwayat Distribusi Obat</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Riwayat Distribusi</li>
                </ol>
            </nav>
        </div>

        <div class="card mb-4">
            <div class="card-body">

                <!-- Filter Tanggal -->
                <div class="card-header">
                    <form method="GET" action="" class="mb-3">
                        <div class="row g-2">
                            <div class="col-auto">
                                <input type="date" name="tanggal" class="form-control" value="<?= $tanggal ?>">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Tampilkan</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Tabel Riwayat -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped datatable">
                        <thead class="table-primary">
                            <tr>
                                <th>Pasien</th>
                                <th>Daftar Obat</th>
                                <th>Jumlah Total Obat</th>
                                <th>Tanggal Distribusi</th>
                                <th>Waktu Distribusi</th>
                                <th>Apoteker</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "
                                SELECT rm.id_rm, p.nama_pasien, pt.nama_petugas AS nama_apoteker, d.tgl_distribusi, d.waktu_distribusi,
                                    GROUP_CONCAT(CONCAT(o.nama_obat, ' (', r.jumlah, ')') SEPARATOR ', ') AS daftar_obat,
                                    SUM(r.jumlah) AS total_jumlah
                                FROM distribusi_obat d
                                JOIN resep_obat r ON d.id_resep = r.id_resep
                                JOIN obat o ON r.kode_obat = o.kode_obat
                                JOIN rekam_medis rm ON r.id_rm = rm.id_rm
                                JOIN pasien p ON rm.nik_pasien = p.nik_pasien
                                JOIN petugas pt ON d.nip_petugas = pt.nip_petugas
                                WHERE DATE(d.tgl_distribusi) = '$tanggal'
                                GROUP BY rm.id_rm, d.tgl_distribusi, d.waktu_distribusi
                                ORDER BY d.tgl_distribusi DESC, d.waktu_distribusi DESC
                            ";
                            $hasil = mysqli_query($conn, $query);
                            while ($data = mysqli_fetch_array($hasil)) {
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($data['nama_pasien']) ?></td>
                                    <td><?= htmlspecialchars($data['daftar_obat']) ?></td>
                                    <td class="text-center"><?= $data['total_jumlah'] ?></td>
                                    <td><?= date('d-m-Y', strtotime($data['tgl_distribusi'])) ?></td>
                                    <td><?= date('H:i', strtotime($data['waktu_distribusi'])) ?></td>
                                    <td><?= htmlspecialchars($data['nama_apoteker']) ?></td>
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
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>