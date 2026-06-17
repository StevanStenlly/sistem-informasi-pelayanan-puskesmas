<?php
session_name("SCREENING_SESSION");
session_start(); //memulai apabila ada login
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

//jika tidak ada login sebelumnya maka diarahkan ke login.php
if ($_SESSION['role'] !== 'screening' || empty($_SESSION['screening_nip'])) {
    echo "<script> window.location = '../login/login-petugas.php' </script>";
    exit();
}

include 'function-screening.php';
$detail = $_GET["id_rm"];
?>

<!DOCTYPE html>
<html lang="id">

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
            <h1>Detail Screening</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="../Kelola_Screening/tabel-screening.php">Kelola Data Screening</a></li>
                    <li class="breadcrumb-item active">Detail Screening</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <?php
        $tampilrm = mysqli_query($conn, "
       SELECT 
           a.*, b.*, 
           a.id_ruang AS id_ruang_rekam, 
           c.nama_ruang, 
           d.nip_petugas, d.nama_petugas 
       FROM rekam_medis a 
       LEFT JOIN pasien b ON a.nik_pasien = b.nik_pasien 
       LEFT JOIN ruang c ON a.id_ruang = c.id_ruang 
       LEFT JOIN petugas d ON a.nip_petugas = d.nip_petugas 
       WHERE a.id_rm = '$detail'
   ");

        while ($data = mysqli_fetch_assoc($tampilrm)) {
            $id_rm = $data['id_rm'];
            $tgl_pemeriksaan  = $data['tgl_pemeriksaan'];
            $nik_pasien = $data['nik_pasien'];
            $status = $data['status'];
            $id_ruang = $data['id_ruang_rekam'];
            $nama_ruang = $data['nama_ruang'];
            $nip_petugas = $data['nip_petugas'];
            $nama_petugas = $data['nama_petugas'];
            $nyeri_telan = $data['nyeri_telan'];
            $demam = $data['demam'];
            $batuk = $data['batuk'];
            $pilek = $data['pilek'];
            $tekanan_darah = $data['tekanan_darah'];
            $nadi = $data['nadi'];
            $siklus_nafas = $data['siklus_nafas'];
            $suhu_badan = $data['suhu_badan'];
            $tinggi_badan = $data['tinggi_badan'];
            $lingkar_perut = $data['lingkar_perut'];
            $lingkar_kepala = $data['lingkar_kepala'];
            $lingkar_dada = $data['lingkar_dada'];
            $berat_badan = $data['berat_badan'];
            $resiko_jatuh = $data['resiko_jatuh'];
            $keterangan_screening = $data['keterangan_screening'];
            $nama_pasien = $data['nama_pasien'];
            $tempat_lahir_pasien = $data['tempat_lahir_pasien'];
            $tgl_lahir_pasien = $data['tgl_lahir_pasien'];
            $bpjs = $data['bpjs'];
            $jk_pasien = $data['jk_pasien'];
            $alamat_pasien = $data['alamat_pasien'];
            $umur = $data['umur'];
            $rm = $data['rm'];
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
                                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Detail Screening</button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Tambah Data Screening</button>
                                    </li>
                                </ul>

                                <div class="tab-content pt-2">

                                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                        <h5 class="card-title">Detail Screening</h5>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- Kolom Kiri -->
                                                <div class="row">
                                                    <div class="col-5 label">Tgl Pemeriksaan</div>
                                                    <div class="col-7">: <?= $tgl_pemeriksaan; ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-5 label">Ruang Pelayanan</div>
                                                    <div class="col-7">: <?= $nama_ruang; ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-5 label">Nama Petugas</div>
                                                    <div class="col-7">: <?= $nama_petugas; ?></div>
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
                                                    <div class="col-5 label">Resiko Jatuh</div>
                                                    <div class="col-7">: <?= $resiko_jatuh; ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-5 label">Keterangan</div>
                                                    <div class="col-7">: <?= $keterangan_screening; ?></div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <!-- Kolom Kanan -->
                                                <div class="row">
                                                    <div class="col-6 label">Nyeri Telan</div>
                                                    <div class="col-4">: <?= $nyeri_telan; ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 label">Demam</div>
                                                    <div class="col-4">: <?= $demam; ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 label">Batuk</div>
                                                    <div class="col-4">: <?= $batuk; ?></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 label">Pilek</div>
                                                    <div class="col-4">: <?= $pilek; ?></div>
                                                </div>
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

                                    </div>

                                    <?php
                                    include 'detail-update.php';
                                    ?>

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