<?php
session_name("APOTEKER_SESSION");
session_start();
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

// ✅ Cek login
if ($_SESSION['role'] !== 'apoteker' || empty($_SESSION['apoteker_nip'])) {
    echo "<script> window.location = '../login/login-petugas.php' </script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <style>
        tr.table-danger {
            background-color: #f8d7da !important;
            color: #842029 !important;
        }
    </style>
    <?php include '../link.php'; ?>
</head>

<body>
    <?php include '../header.php'; ?>
    <?php include '../siderbar.php'; ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Laporan Stok Obat</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Laporan Stok Obat</li>
                </ol>
            </nav>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="mb-3 mt-3">
                    <form method="GET" action="cetak-laporan.php" target="_blank" class="mb-3">
                        <label for="filterLaporan" class="fw-bold">Pilih Jenis Laporan:</label>
                        <div class="input-group mb-2" style="max-width: 400px;">
                            <select name="filterLaporan" id="filterLaporan" class="form-select">
                                <option value="semua">Semua Obat (Tidak Kadaluarsa & Stok Aman)</option>
                                <option value="kadaluarsa">Obat Kadaluarsa</option>
                                <option value="stok_tipis">Obat Stok Hampir Habis</option>
                            </select>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-printer"></i> Cetak Laporan</button>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped" id="dataTable">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Obat</th>
                                    <th>Nama Obat</th>
                                    <th>Dosis Obat</th>
                                    <th>Satuan</th>
                                    <th>Stok</th>
                                    <th>Kadaluarsa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ambilsemuahasil = mysqli_query($conn, "SELECT * FROM obat");
                                $i = 1;
                                while ($data = mysqli_fetch_array($ambilsemuahasil)) {
                                    $ido = $data['kode_obat'];
                                    $nama_obat = $data['nama_obat'];
                                    $dosis_obat = $data['dosis_obat'];
                                    $satuan = $data['satuan'];
                                    $stok = $data['stok_obat'];
                                    $tgl_kadaluarsa = $data['tgl_kadaluarsa'];

                                    $expired = '';
                                    $is_expired = false;
                                    if (!empty($tgl_kadaluarsa)) {
                                        $tgl_obj = DateTime::createFromFormat('Y-m-d', $tgl_kadaluarsa);
                                        if ($tgl_obj && $tgl_obj < new DateTime()) {
                                            $expired = 'table-danger';
                                            $is_expired = true;
                                        }
                                    }

                                    echo "<tr class='$expired' data-expired='" . ($is_expired ? "1" : "0") . "' data-stok='$stok'>
                                    <td class='text-center'>{$i}</td>
                                    <td>{$ido}</td>
                                    <td>{$nama_obat}</td>
                                    <td>{$dosis_obat}</td>
                                    <td>{$satuan}</td>
                                    <td class='text-center'>{$stok}</td>
                                    <td class='text-center'>" . date('Y-m-d', strtotime($tgl_kadaluarsa));
                                    if ($is_expired) echo "<span class='badge bg-danger ms-1'>Kadaluarsa</span>";
                                    echo "</td></tr>";

                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </main>

    <?php include '../footer.php'; ?>

    <!-- JS Plugins -->
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
            const tableElement = document.querySelector("#dataTable");
            const filterSelect = document.getElementById("filterLaporan");

            const originalData = Array.from(tableElement.querySelectorAll("tbody tr")).map(row => {
                return {
                    html: row.outerHTML,
                    expired: row.dataset.expired === "1",
                    stok: parseInt(row.dataset.stok)
                };
            });

            let dataTable = new simpleDatatables.DataTable(tableElement);

            function applyFilter() {
                const jenis = filterSelect.value;

                dataTable.destroy();
                tableElement.querySelector("tbody").innerHTML = "";

                const filteredData = originalData.filter(item => {
                    if (jenis === "kadaluarsa") return item.expired;
                    if (jenis === "stok_tipis") return item.stok < 50;
                    if (jenis === "semua") return !item.expired && item.stok >= 50;
                    return true;
                });

                tableElement.querySelector("tbody").innerHTML = filteredData.map(item => item.html).join("");
                dataTable = new simpleDatatables.DataTable(tableElement);
            }

            filterSelect.addEventListener("change", applyFilter);
            applyFilter();
        });
    </script>
</body>

</html>