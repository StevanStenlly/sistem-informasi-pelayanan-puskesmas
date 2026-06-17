<?php
session_name("APOTEKER_SESSION");
session_start();
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if ($_SESSION['role'] !== 'apoteker' || empty($_SESSION['apoteker_nip'])) {
    echo "<script> window.location = '../login/login-petugas.php' </script>";
    exit();
}

$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
$tanggal_awal = "$tahun-$bulan-01";
$tanggal_akhir = date("Y-m-t", strtotime($tanggal_awal));

// Data laporan
$jumlah_kunjungan = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM rekam_medis WHERE tgl_pemeriksaan BETWEEN '$tanggal_awal' AND '$tanggal_akhir'"))[0];

$jumlah_resep = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM resep_obat ro JOIN rekam_medis rm ON ro.id_rm = rm.id_rm WHERE rm.tgl_pemeriksaan BETWEEN '$tanggal_awal' AND '$tanggal_akhir'"))[0];

$obat_masuk = mysqli_fetch_row(mysqli_query($conn, "SELECT SUM(jumlah_masuk) FROM obat_masuk WHERE tanggal_masuk BETWEEN '$tanggal_awal' AND '$tanggal_akhir'"))[0] ?? 0;

$distribusi_obat = mysqli_fetch_row(mysqli_query($conn, "
  SELECT SUM(ro.jumlah) 
  FROM distribusi_obat d
  JOIN resep_obat ro ON d.id_resep = ro.id_resep
  WHERE d.tgl_distribusi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
"))[0] ?? 0;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../link.php'; ?>
    <title>Laporan Bulanan</title>
</head>

<body>
    <?php include '../header.php';
    include '../siderbar.php'; ?>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Laporan Bulanan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Laporan Bulanan</li>
                </ol>
            </nav>
        </div>

        <div class="card mb-3">
            <div class="card-header bg-primary text-white">Filter Laporan</div>
            <div class="card-body">
                <form method="GET" class="row g-3">
                    <div class="col-md-3">
                        <label for="bulan">Bulan</label>
                        <select name="bulan" class="form-select">
                            <?php
                            for ($b = 1; $b <= 12; $b++) {
                                $selected = ($b == $bulan) ? 'selected' : '';
                                $nama_bulan_indonesia = [
                                    1 => 'Januari',
                                    2 => 'Februari',
                                    3 => 'Maret',
                                    4 => 'April',
                                    5 => 'Mei',
                                    6 => 'Juni',
                                    7 => 'Juli',
                                    8 => 'Agustus',
                                    9 => 'September',
                                    10 => 'Oktober',
                                    11 => 'November',
                                    12 => 'Desember'
                                ];

                                echo "<option value='" . str_pad($b, 2, '0', STR_PAD_LEFT) . "' $selected>{$nama_bulan_indonesia[$b]}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="tahun">Tahun</label>
                        <select name="tahun" class="form-select">
                            <?php
                            $tahun_sekarang = date('Y');
                            for ($t = $tahun_sekarang; $t >= $tahun_sekarang - 5; $t--) {
                                $selected = ($t == $tahun) ? 'selected' : '';
                                echo "<option value='$t' $selected>$t</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3 align-self-end">
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-success text-white">Hasil Laporan Bulan <?= $nama_bulan_indonesia[(int)$bulan] ?>
                <?= $tahun ?></div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Jumlah Kunjungan Pasien</th>
                        <td><?= $jumlah_kunjungan ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah Resep Dikeluarkan</th>
                        <td><?= $jumlah_resep ?></td>
                    </tr>
                    <tr>
                        <th>Total Obat Masuk</th>
                        <td><?= $obat_masuk ?></td>
                    </tr>
                    <tr>
                        <th>Total Obat Didistribusikan</th>
                        <td><?= $distribusi_obat ?></td>
                    </tr>
                </table>
                <a href="cetak-laporan-bulanan.php?bulan=<?= $bulan ?>&tahun=<?= $tahun ?>" target="_blank" class="btn btn-danger mt-3">
                    <i class="bi bi-file-earmark-pdf"></i> Cetak PDF
                </a>

            </div>
        </div>
    </main>
    <?php include '../footer.php'; ?>
</body>

</html>