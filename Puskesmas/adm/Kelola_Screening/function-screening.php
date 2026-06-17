<?php
require '../../koneksi.php';

//Menambah data screening
if (isset($_POST['addnewscreening'])) {
    $nik_pasien = $_POST['nik_pasien'];
    $sakit = $_POST['sakit'];
    $tgl_pemeriksaan = $_POST['tgl_pemeriksaan'];

    $query = mysqli_query($conn, "INSERT into rekam_medis (nik_pasien, sakit, tgl_pemeriksaan) VALUES ('$nik_pasien', '$sakit', '$tgl_pemeriksaan')");

    if ($query) {
        echo "<script>  window.location='tabel-screening.php';</script>";
    } else {
        echo "<script> alert('Proses tambah Screening gagal'); history.back();</script>";
    }
}

//Update Data screening
$ambilsemuascreening = mysqli_query($conn, "SELECT * FROM rekam_medis a left join pasien b on a.nik_pasien=b.nik_pasien 
left join ruang c on a.id_ruang=c.id_ruang left join petugas d on a.nip_petugas=d.nip_petugas");

$data = mysqli_fetch_array($ambilsemuascreening);

if (isset($_POST['updatescreening'])) {
    $id_rm = $_POST['id_rm'];
    $tgl_pemeriksaan = $_POST['tgl_pemeriksaan'];
    $id_ruang = $_POST['id_ruang'];
    $nip_petugas = $_POST['nip_petugas'];
    $nyeri_telan = $_POST['nyeri_telan'];
    $demam = $_POST['demam'];
    $batuk = $_POST['batuk'];
    $pilek = $_POST['pilek'];
    $tekanan_darah = $_POST['tekanan_darah'];
    $nadi = $_POST['nadi'];
    $siklus_nafas = $_POST['siklus_nafas'];
    $suhu_badan = $_POST['suhu_badan'];
    $tinggi_badan = $_POST['tinggi_badan'];
    $lingkar_perut = $_POST['lingkar_perut'];
    $lingkar_kepala = $_POST['lingkar_kepala'];
    $lingkar_dada = $_POST['lingkar_dada'];
    $berat_badan = $_POST['berat_badan'];
    $resiko_jatuh = $_POST['resiko_jatuh'];
    $keterangan_screening = $_POST['keterangan_screening'];

    $query = "UPDATE rekam_medis SET tgl_pemeriksaan='$tgl_pemeriksaan', id_ruang='$id_ruang', nip_petugas='$nip_petugas', nyeri_telan='$nyeri_telan', 
    demam='$demam', batuk='$batuk', pilek='$pilek', tekanan_darah='$tekanan_darah', nadi='$nadi', siklus_nafas='$siklus_nafas', suhu_badan='$suhu_badan', 
    tinggi_badan='$tinggi_badan', lingkar_perut='$lingkar_perut', lingkar_kepala='$lingkar_kepala', lingkar_dada='$lingkar_dada', berat_badan='$berat_badan', 
    resiko_jatuh='$resiko_jatuh', keterangan_screening='$keterangan_screening' WHERE id_rm='$id_rm'";

    $hasil = mysqli_query($conn, $query);
    if ($hasil) {
        echo "<script> alert('Proses edit Screening berhasil'); window.location='detail-screening.php?id_rm=$id_rm';</script>";
    } else {
        echo "<script> alert('Proses edit Screening gagal'); window.location='detail-screening.php?id_rm=$id_rm';</script>";
    }
}


//Delete screening
if (isset($_POST['deletescreening'])) {
    $id_rm = $_POST['id_rm'];

    $hapus = mysqli_query($conn, "DELETE FROM rekam_medis where id_rm='$id_rm'");
    if ($hapus) {
        echo "<script> window.location='tabel-screening.php';</script>";
    } else {
        echo "<script> alert('Proses Hapus Data Screening Gagal')</script>";
        header('location:tabel-screening.php');
    }
}
