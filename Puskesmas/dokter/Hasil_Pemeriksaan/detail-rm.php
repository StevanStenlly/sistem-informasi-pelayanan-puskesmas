<?php
session_name("DOKTER_SESSION");
session_start(); //memulai apabila ada login
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

// Validasi Login Dokter
if ($_SESSION['role'] !== 'dokter' || empty($_SESSION['dokter_nip'])) {
    echo "<script> window.location = '../login/login-dokter.php' </script>";
    exit();
}

require 'function-hp.php';
$detail = $_GET["id_rm"];
$id_sumber = isset($_GET['id_sumber']) ? $_GET['id_sumber'] : $detail;
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include '../link.php';
    ?>

</head>

<body>

    <?php
    include '../header.php';
    include '../siderbar.php';
    ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Detail Rekam Medis</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="tabel-hp.php">Kelola Hasil Pemeriksaan</a></li>
                    <?php
                    $id_ru = $_SESSION['ruang_id'];
                    $ambilsemuahasil = mysqli_query($conn, "SELECT * FROM rekam_medis a left join pasien d on a.nik_pasien=d.nik_pasien WHERE id_rm = '$detail' ");
                    ($data = mysqli_fetch_array($ambilsemuahasil));
                    $id_rm = $data['id_rm'];
                    ?>

                    <li class="breadcrumb-item">
                        <a href="detail-hp.php?id_rm=<?= $id_sumber; ?>">Detail Hasil Pemeriksaan</a>
                    </li>

                    <?php

                    ?>
                    <?php
                    $id_ru = $_SESSION['ruang_id'];
                    $ambilsemuahasil = mysqli_query($conn, "SELECT * FROM rekam_medis a left join pasien d on a.nik_pasien=d.nik_pasien WHERE id_rm = '$detail' ");
                    ($data = mysqli_fetch_array($ambilsemuahasil));
                    $id_rm = $data['id_rm'];
                    ?>

                    <li class="breadcrumb-item">
                        <a href="tabel-rm.php?nik_pasien=<?= $data["nik_pasien"]; ?>&id_rm=<?= $id_sumber; ?>">Rekam Medis</a>
                    </li>

                    <?php

                    ?>
                    <li class="breadcrumb-item active">Detail Rekam Medis</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <?php
        $ambilsemuahasil = mysqli_query($conn, "SELECT * FROM rekam_medis a left join ruang c on a.id_ruang=c.id_ruang 
        left join pasien d on a.nik_pasien=d.nik_pasien left join dokter e on a.nip_dokter=e.nip_dokter WHERE id_rm = '$detail' ");
        while ($data = mysqli_fetch_array($ambilsemuahasil)) {
            $id_rm = $data['id_rm'];
            $ICD_10 = $data['ICD_10'];
            $nama_penyakit = $data['nama_penyakit'];
            $keterangan_hasil = $data['keterangan_hasil'];
            $resep_obat = $data['resep_obat'];
            $nip_dokter = $data['nip_dokter'];
            $nama_dokter = $data['nama_dokter'];
            $tekanan_darah = $data['tekanan_darah'];
            $nadi = $data['nadi'];
            $siklus_nafas = $data['siklus_nafas'];
            $suhu_badan = $data['suhu_badan'];
            $tinggi_badan = $data['tinggi_badan'];
            $lingkar_perut = $data['lingkar_perut'];
            $lingkar_kepala = $data['lingkar_kepala'];
            $lingkar_dada = $data['lingkar_dada'];
            $berat_badan = $data['berat_badan'];
            $nik_pasien  = $data['nik_pasien'];
            $tgl_pemeriksaan = $data['tgl_pemeriksaan'];
            $sakit = $data['sakit'];
            $nama_pasien = $data['nama_pasien'];
            $jk_pasien = $data['jk_pasien'];
            $id_ruang = $data['id_ruang'];
            $nama_ruang = $data['nama_ruang'];
            $rm = $data['rm'];
            $alamat_pasien = $data['alamat_pasien'];
            $tempat_lahir_pasien = $data['tempat_lahir_dokter'];
            $tgl_lahir_pasien = $data['tgl_lahir_dokter'];
            $bpjs = $data['bpjs'];
            $umur = $data['umur'];
        ?>

            <section class="section profile">


                <div class="row">
                    <div class="col-xl-4">

                        <div class="card">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                                <img src="../../adm/Kelola_Pasien/img/<?php echo $data['foto_pasien']; ?>" alt="<?php echo $data['foto_pasien']; ?>" class="rounded-circle">
                                <h2><?php echo $data['nama_pasien']; ?></h2>
                                <h2><?php echo $data['nik_pasien']; ?></h2>

                            </div>
                        </div>

                    </div>

                    <div class="col-xl-8">

                        <div class="card">
                            <div class="card-body pt-3">
                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered">

                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Detail Hasil Pemeriksaan</button>
                                    </li>

                                </ul>

                                <div class="tab-content pt-2">

                                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                        <h5 class="card-title">Detail Hasil Pemeriksaan</h5>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- Kolom Kiri -->
                                                <div class="row">
                                                    <div class="col-5 label">Tgl Pemeriksaan</div>
                                                    <div class="col-7">: <?= $tgl_pemeriksaan; ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-5 label">Nama Dokter</div>
                                                    <div class="col-7">: <?= $nama_dokter; ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-5 label">BPJS</div>
                                                    <div class="col-7">: <?= $bpjs; ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-5 label">NO.Rekam Medis</div>
                                                    <div class="col-7">: K-<?= $rm; ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-5 label">Umur</div>
                                                    <div class="col-7">: <?= $umur; ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-5 label">Jenis Kelamin</div>
                                                    <div class="col-7">: <?= $jk_pasien; ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-5 label">ICD 10</div>
                                                    <div class="col-7">: <?= $ICD_10; ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-5 label">Nama Penyakit</div>
                                                    <div class="col-7">: <?= $nama_penyakit; ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-5 label">Keterangan</div>
                                                    <div class="col-7">: <?= $keterangan_hasil; ?></div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <!-- Kolom Kanan -->
                                                <div class="row">
                                                    <div class="col-6 label">TD (Tekanan Darah)</div>
                                                    <div class="col-4">: <?= $tekanan_darah; ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 label">N (Nadi)</div>
                                                    <div class="col-4">: <?= $nadi; ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 label">RR (Siklus Nafas)</div>
                                                    <div class="col-4">: <?= $siklus_nafas; ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 label">T (Suhu Badan)</div>
                                                    <div class="col-4">: <?= $suhu_badan; ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 label">Tinggi Badan</div>
                                                    <div class="col-4">: <?= $tinggi_badan; ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 label">Lingkar Perut</div>
                                                    <div class="col-4">: <?= $lingkar_perut; ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 label">Lingkar Kepala</div>
                                                    <div class="col-4">: <?= $lingkar_kepala; ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 label">Lingkar Dada</div>
                                                    <div class="col-4">: <?= $lingkar_dada; ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 label">Berat Badan</div>
                                                    <div class="col-4">: <?= $berat_badan; ?></div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                        include 'rujuk-rm.php';
                                        ?>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

            </section>

        <?php
        };
        ?>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php
    include '../footer.php';
    ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>

</body>

</html>