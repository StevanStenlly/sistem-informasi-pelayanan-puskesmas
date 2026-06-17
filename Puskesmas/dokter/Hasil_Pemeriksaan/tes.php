<h5 class="card-title">Detail Hasil Pemeriksaan</h5>

<div class="row">
    <div class="col-lg-3 col-md-4 label ">Tgl Pemeriksaan</div>
    <div class="col-lg-9 col-md-8"><?= $tgl_pemeriksaan; ?></div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-4 label ">Nama Dokter</div>

    <?php
    $nip_dok = $_SESSION['dokter_nip'];

    $ambilsemuadokter = mysqli_query($conn, "SELECT * FROM dokter WHERE nip_dokter='$nip_dok'");
    while ($data = mysqli_fetch_array($ambilsemuadokter)) {
    ?>
        <div class="col-lg-9 col-md-8"><?= $nama_dokter; ?></div>

    <?php
    };
    ?>
</div>

<div class="row">
    <div class="col-lg-3 col-md-4 label ">BPJS</div>
    <div class="col-lg-9 col-md-8"><?= $bpjs; ?></div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-4 label ">NO.Rekam Medis</div>
    <div class="col-lg-9 col-md-8">K-<?= $rm; ?></div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-4 label ">Umur</div>
    <div class="col-lg-9 col-md-8"><?= $umur; ?></div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-4 label ">Jenis Kelamin</div>
    <div class="col-lg-9 col-md-8"><?= $jk_pasien; ?></div>
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

<?php
include 'kode.php';
?>