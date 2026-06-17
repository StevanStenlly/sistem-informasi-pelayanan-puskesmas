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
            <h1>Detail Hasil Pemeriksaan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../Dashboard/index.php">Dashboard</a></li>
                    <li class="breadcrumb-item">Kelola Data Hasil Pemeriksaan</li>
                    <li class="breadcrumb-item active">Detail Hasil Pemeriksaan</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <?php
        $ambilsemuahasil = mysqli_query($conn, "SELECT * FROM rekam_medis a left join ruang c on a.id_ruang=c.id_ruang 
        left join pasien d on a.nik_pasien=d.nik_pasien left join dokter e on a.nip_dokter=e.nip_dokter 
        WHERE id_rm = '$detail' ");
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
            $tempat_lahir_pasien = $_POST['tempat_lahir_pasien'];
            $tgl_lahir_pasien = $_POST['tgl_lahir_pasien'];
            $bpjs = $data['bpjs'];
            $umur = $data['umur'];
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
                                            <div class="col-lg-3 col-md-4 label ">BPJS</div>
                                            <div class="col-lg-9 col-md-8"><?= $bpjs; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">NO.Rekam Medis</div>
                                            <div class="col-lg-9 col-md-8">K-<?php echo $data['rm']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Tempat Lahir</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $data['tempat_lahir_pasien']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Tanggal Lahir</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $data['tgl_lahir_pasien']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Umur</div>
                                            <div class="col-lg-9 col-md-8"><?= $umur; ?></div>
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
                                            <div class="col-lg-3 col-md-4 label ">ICD 10</div>
                                            <div class="col-lg-9 col-md-8"><?= $ICD_10; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Nama Penyakit</div>
                                            <div class="col-lg-9 col-md-8"><?= $nama_penyakit; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Keterangan</div>
                                            <div class="col-lg-9 col-md-8"><?= $keterangan_hasil; ?></div>
                                        </div>

                                        <h5 class="card-title mt-4">Riwayat Resep Obat</h5>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead class="table-secondary">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Obat</th>
                                                        <th>Dosis</th>
                                                        <th>Jumlah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $riwayat = mysqli_query($conn, "SELECT r.*, o.nama_obat, o.dosis_obat, o.satuan FROM resep_obat r 
                                                    LEFT JOIN obat o ON r.kode_obat = o.kode_obat 
                                                    WHERE r.id_rm = '$id_rm' ORDER BY id_resep DESC");
                                                    $no = 1;
                                                    while ($res = mysqli_fetch_array($riwayat)) {
                                                        $dosis_obat = $res['dosis_obat'];
                                                        $satuan = $res['satuan'];
                                                    ?>
                                                        <tr>
                                                            <td><?= $no++; ?></td>
                                                            <td><?= $res['nama_obat']; ?> <?= $dosis_obat; ?> <?= $satuan; ?></td>
                                                            <td><?= $res['dosis']; ?></td>
                                                            <td><?= $res['jumlah']; ?></td>
                                                        </tr>

                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="text-center">
                                            <a href="cetak-pdf.php?id_rm=<?= $id_rm; ?>" class="btn btn-outline-primary btn-sm" target="_blank">
                                                <i class="bi bi-printer-fill"></i> Cetak PDF
                                            </a>
                                        </div>

                                        <h5 class="card-title mt-4">Riwayat Surat Rujukan</h5>

                                        <table class="table table-bordered table-striped">
                                            <thead class="table-primary">
                                                <tr class="text-center">
                                                    <th>No</th>
                                                    <th>Nomor Rujukan</th>
                                                    <th>Tanggal</th>
                                                    <th>Fasilitas Tujuan</th>
                                                    <th>Poli Tujuan</th>
                                                    <th>Dokter/Admin</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $rujukan_q = mysqli_query($conn, "SELECT * FROM surat_rujukan WHERE id_rm = '$id_rm' ORDER BY tanggal_rujukan DESC");
                                                $no = 1;
                                                while ($rj = mysqli_fetch_assoc($rujukan_q)) {
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?= $no++; ?></td>
                                                        <td><?= $rj['no_rujukan']; ?></td>
                                                        <td class="text-center"><?= $rj['tanggal_rujukan']; ?></td>
                                                        <td><?= $rj['fasilitas_tujuan']; ?></td>
                                                        <td><?= $rj['poli_tujuan']; ?></td>
                                                        <td><?= $rj['nama_pengirim']; ?></td>
                                                        <td class="text-center">
                                                            <a href="cetak-rujukan.php?id=<?= $rj['id_rujukan']; ?>" class="btn btn-sm btn-outline-primary" target="_blank">
                                                                <i class="bi bi-printer"></i> Cetak
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

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