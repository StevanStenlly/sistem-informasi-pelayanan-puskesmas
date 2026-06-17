<?php
session_name("APOTEKER_SESSION");
session_start();
include '../../koneksi.php';

if ($_SESSION['role'] !== 'apoteker' || empty($_SESSION['apoteker_nip'])) {
    echo "<script> window.location = '../login/login-petugas.php' </script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <?php include '../link.php'; ?>
    <title>Daftar Resep dari Dokter</title>
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
            <h1>Resep Obat</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Resep Obat</li>
                </ol>
            </nav>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped hidden-until-ready" id="dataTable">
                        <thead class="table-primary">
                            <tr>
                                <th>Pasien</th>
                                <th>Detail Resep</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT 
                                rm.id_rm,
                                p.nama_pasien,
                                GROUP_CONCAT(CONCAT(o.nama_obat, ' (', r.dosis, ', ', r.jumlah, ')') SEPARATOR '<br>') AS detail_resep
                                FROM resep_obat r
                                JOIN rekam_medis rm ON r.id_rm = rm.id_rm
                                JOIN pasien p ON rm.nik_pasien = p.nik_pasien
                                JOIN obat o ON r.kode_obat = o.kode_obat
                                WHERE r.status = 'belum'
                                GROUP BY rm.id_rm";

                            $res = mysqli_query($conn, $query);
                            while ($data = mysqli_fetch_array($res)) {
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($data['nama_pasien']) ?></td>
                                    <td><?= $data['detail_resep'] ?></td>
                                    <td class="text-center">
                                        <form action="verifikasi-resep.php" method="POST">
                                            <input type="hidden" name="id_rm" value="<?= $data['id_rm'] ?>">
                                            <button class="btn btn-success btn-sm" type="submit" name="beri_semua_obat">Berikan</button>
                                        </form>
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

            const dataTable = new simpleDatatables.DataTable(tableEl, {
                labels: {
                    noRows: "Tidak ada data resep yang ditemukan.",
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