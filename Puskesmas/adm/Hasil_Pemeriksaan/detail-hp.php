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

require 'function-hp.php';
$detail = $_GET["id_hasil"];
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
            <h1>Detail Hasil Pemeriksaan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Kelola Data Hasil Pemeriksaan</li>
                    <li class="breadcrumb-item active">Detail Hasil Pemeriksaan</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <?php
        $ambilsemuahasil = mysqli_query($conn, "SELECT * FROM hasil_pemeriksaan a left join screening b on a.id_screening=b.id_screening
        left join ruang c on a.id_ruang=c.id_ruang left join pasien d on a.nik_pasien=d.nik_pasien left join dokter e on a.nip_dokter=e.nip_dokter WHERE id_hasil = '$detail' ");
        while ($data = mysqli_fetch_array($ambilsemuahasil)) {
            $id_hasil = $data['id_hasil'];
            $ICD_10 = $data['ICD_10'];
            $nama_penyakit = $data['nama_penyakit'];
            $keterangan_hasil = $data['keterangan_hasil'];
            $resep_obat = $data['resep_obat'];
            $nip_dokter = $data['nip_dokter'];
            $nama_dokter = $data['nama_dokter'];
            $id_screening = $data['id_screening'];
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
            $ttl_pasien = $data['ttl_pasien'];
            $jk_pasien = $data['jk_pasien'];
            $id_ruang = $data['id_ruang'];
            $nama_ruang = $data['nama_ruang'];
            $rm = $data['rm'];
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
                                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Detail Hasil Pemeriksaan</button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Ubah Hasil Pemeriksaan</button>
                                    </li>

                                </ul>

                                <div class="tab-content pt-2">

                                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                        <h5 class="card-title">Detail Hasil Pemeriksaan</h5>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Tanggal Pemeriksaan</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $data['tgl_pemeriksaan']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Nama Petugas</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $data['nama_dokter']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Nama Pasien</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $data['nama_pasien']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">NIK</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $data['nik_pasien']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">NO.Kartu Pasien</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $data['no_kartu_pasien']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">NO.Rekam Medis</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $data['rm']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Tempat Tanggal Lahir</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $data['ttl_pasien']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Jenis Kelamin</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $data['jk_pasien']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Alamat</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $data['alamat_pasien']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">TD</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $data['tekanan_darah']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">N</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $data['nadi']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">RR</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $data['siklus_nafas']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">T (Suhu)</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $data['suhu_badan']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">TB</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $data['tinggi_badan']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">LP</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $data['lingkar_perut']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">LK</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $data['lingkar_kepala']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">LD</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $data['lingkar_dada']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">BB</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $data['berat_badan']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">ICD 10</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $data['ICD_10']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Nama Penyakit</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $data['nama_penyakit']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Keterangan</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $data['keterangan_hasil']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Resep Obat</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $data['resep_obat']; ?></div>
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