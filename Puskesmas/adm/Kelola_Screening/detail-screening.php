<?php
session_name("ADMIN_SESSION");
session_start(); //memulai apabila ada login
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

//jika tidak ada login sebelumnya maka diarahkan ke login.php
if ($_SESSION['role'] !== 'admin' || empty($_SESSION['admin_id'])) {
    echo "<script> window.location = '../login/login-admin.php' </script>";
    exit();
}

require 'function-screening.php';
$detail = $_GET["id_rm"];
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
            <h1>Detail Screening</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Kelola Data Screening</li>
                    <li class="breadcrumb-item active">Detail Screening</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <?php
        $tampilscreening = mysqli_query($conn, "SELECT * FROM rekam_medis a left join pasien b on a.nik_pasien=b.nik_pasien 
        left join ruang c on a.id_ruang=c.id_ruang left join petugas d on a.nip_petugas=d.nip_petugas WHERE id_rm = '$detail' ");
        while ($data = mysqli_fetch_array($tampilscreening)) {
            $id_rm = $data['id_rm'];
            $tgl_pemeriksaan  = $data['tgl_pemeriksaan'];
            $nik_pasien  = $data['nik_pasien'];
            $status = $data['status'];
            $id_ruang = $data['id_ruang'];
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
            $ttl_pasien = $data['ttl_pasien'];
            $jk_pasien = $data['jk_pasien'];
            $alamat_pasien = $data['alamat_pasien'];
        ?>

            <section class="section profile">


                <div class="row">
                    <div class="col-xl-4">

                        <div class="card">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                                <img src="../Kelola_Pasien/img/<?php echo $data['foto_pasien']; ?>" alt="<?php echo $data['foto_pasien']; ?>" class="rounded-circle">
                                <h2><?php echo $data['nama_pasien']; ?></h2>

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
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Ubah Detail Screening</button>
                                    </li>

                                </ul>

                                <div class="tab-content pt-2">

                                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                        <h5 class="card-title">Detail Screening</h5>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Tanggal Pemeriksaan</div>
                                            <div class="col-lg-9 col-md-8"><?= $tgl_pemeriksaan; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Ruang Pelayanan</div>
                                            <div class="col-lg-9 col-md-8"><?= $nama_ruang; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Nama Petugas</div>
                                            <div class="col-lg-9 col-md-8"><?= $nama_petugas; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Nama Pasien</div>
                                            <div class="col-lg-9 col-md-8"><?= $nama_pasien; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">NIK</div>
                                            <div class="col-lg-9 col-md-8"><?= $nik_pasien; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Tempat Tanggal Lahir</div>
                                            <div class="col-lg-9 col-md-8"><?= $ttl_pasien; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Jenis Kelamin</div>
                                            <div class="col-lg-9 col-md-8"><?= $jk_pasien; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Alamat</div>
                                            <div class="col-lg-9 col-md-8"><?= $alamat_pasien; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Nyeri Telan</div>
                                            <div class="col-lg-9 col-md-8"><?= $nyeri_telan; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Demam</div>
                                            <div class="col-lg-9 col-md-8"><?= $demam; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Batuk</div>
                                            <div class="col-lg-9 col-md-8"><?= $batuk; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Pilek</div>
                                            <div class="col-lg-9 col-md-8"><?= $pilek; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">TD (Tekanan Darah)</div>
                                            <div class="col-lg-9 col-md-8"><?= $tekanan_darah; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">N (Nadi)</div>
                                            <div class="col-lg-9 col-md-8"><?= $nadi; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">RR (Siklus Nafas)</div>
                                            <div class="col-lg-9 col-md-8"><?= $siklus_nafas; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">T (Suhu Badan)</div>
                                            <div class="col-lg-9 col-md-8"><?= $suhu_badan; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Tinggi Badan</div>
                                            <div class="col-lg-9 col-md-8"><?= $tinggi_badan; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Lingkar Perut</div>
                                            <div class="col-lg-9 col-md-8"><?= $lingkar_perut; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Lingkar Kepala</div>
                                            <div class="col-lg-9 col-md-8"><?= $lingkar_kepala; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Lingkar Dada</div>
                                            <div class="col-lg-9 col-md-8"><?= $lingkar_dada; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Berat Badan</div>
                                            <div class="col-lg-9 col-md-8"><?= $berat_badan; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Resiko Jatuh</div>
                                            <div class="col-lg-9 col-md-8"><?= $resiko_jatuh; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Keterangan</div>
                                            <div class="col-lg-9 col-md-8"><?= $keterangan_screening; ?></div>
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
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
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