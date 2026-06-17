<?php

//Menambah data screening
if (isset($_POST['addnewscreening'])) {
    $nik_pasien = $_POST['nik_pasien'];
    $sakit = $_POST['sakit'];
    $umur = $_POST['umur'];
    $tgl_pemeriksaan = $_POST['tgl_pemeriksaan'];
    $tgl_lahir_pasien = $_POST['tgl_lahir_pasien'];

    // Hitung umur berdasarkan tanggal lahir
    $today = new DateTime();
    $birthdate = new DateTime($tgl_lahir_pasien ?? 'now');
    $diff = $today->diff($birthdate);
    $umur = $diff->y; // hasil dalam tahun
    $status_screening = 'Belum Diperiksa';


    $query = mysqli_query($conn, "INSERT INTO rekam_medis 
    (nik_pasien, sakit, tgl_pemeriksaan, umur, status_screening) 
    VALUES ('$nik_pasien', '$sakit', '$tgl_pemeriksaan', '$umur', '$status_screening')");


    if ($query) {
        echo "<script> window.location='tabel-screening.php';</script>";
    } else {
        echo "<script> alert('Proses tambah data gagal');  history.back();</script>";
    }
}

if (isset($_POST['updatepasien'])) {
    $id_rm = $_POST['id_rm'];
    $nik_pasien = $_POST['nik_pasien'];

    // Data pasien
    $tinggi_badan = $_POST['tinggi_badan'];
    $lingkar_perut = $_POST['lingkar_perut'];
    $lingkar_kepala = $_POST['lingkar_kepala'];
    $lingkar_dada = $_POST['lingkar_dada'];
    $berat_badan = $_POST['berat_badan'];
    $tgl_lahir_pasien = $_POST['tgl_lahir_pasien'];

    // Hitung umur berdasarkan tanggal lahir
    $today = new DateTime();
    $birthdate = new DateTime($tgl_lahir_pasien);
    $diff = $today->diff($birthdate);
    $umur = $diff->y; // hasil dalam tahun


    // Data rekam_medis
    $id_ruang = $_POST['id_ruang'];
    $tgl_pemeriksaan = $_POST['tgl_pemeriksaan'];
    $nip_petugas = $_POST['nip_petugas'];
    $nyeri_telan = $_POST['nyeri_telan'];
    $demam = $_POST['demam'];
    $batuk = $_POST['batuk'];
    $pilek = $_POST['pilek'];
    $tekanan_darah = $_POST['tekanan_darah'];
    $nadi = $_POST['nadi'];
    $siklus_nafas = $_POST['siklus_nafas'];
    $suhu_badan = $_POST['suhu_badan'];
    $resiko_jatuh = $_POST['resiko_jatuh'];
    $keterangan_screening = $_POST['keterangan_screening'];
    $status_screening = 'Sudah Diperiksa';

    // Update pasien
    $updatePasien = mysqli_query($conn, "UPDATE pasien SET 
        tinggi_badan = '$tinggi_badan',
        lingkar_perut = '$lingkar_perut',
        lingkar_kepala = '$lingkar_kepala',
        lingkar_dada = '$lingkar_dada',
        berat_badan = '$berat_badan',
        tgl_lahir_pasien='$tgl_lahir_pasien'
        WHERE nik_pasien = '$nik_pasien'");

    // Update rekam medis
    $updateRM = mysqli_query($conn, "UPDATE rekam_medis SET 
    tgl_pemeriksaan='$tgl_pemeriksaan', 
    id_ruang='$id_ruang', 
    nip_petugas='$nip_petugas', 
    nyeri_telan='$nyeri_telan', 
    demam='$demam', 
    batuk='$batuk', 
    pilek='$pilek',
    umur='$umur',
    tekanan_darah='$tekanan_darah', 
    nadi='$nadi', 
    siklus_nafas='$siklus_nafas', 
    suhu_badan='$suhu_badan', 
    resiko_jatuh='$resiko_jatuh', 
  keterangan_screening='$keterangan_screening',
  status_screening='$status_screening'
  WHERE id_rm = '$id_rm'");


    if ($updatePasien && $updateRM) {
        echo "<script>
            window.location.href='detail-screening.php?id_rm=$id_rm';
        </script>";
    } else {
        echo "<script>
            alert('Gagal memperbarui data');
        </script>";
    }
}

//Delete screening
if (isset($_POST['deletescreening'])) {
    $id_rm = $_POST['id_rm'];

    $hapus = mysqli_query($conn, "DELETE FROM rekam_medis where id_rm='$id_rm'");
    if ($hapus) {
        echo "<script>  window.location='tabel-screening.php';</script>";
    } else {
        echo "<script> </script>";
        header('location:tabel-screening.php');
    }
}
