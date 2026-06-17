<?php

//Update Data Hasil Pemeriksaan
$ambilsemuahasil = mysqli_query($conn, "SELECT * FROM rekam_medis a left join dokter b on a.nip_dokter=b.nip_dokter");

$data = mysqli_fetch_array($ambilsemuahasil);

if (isset($_POST['updatehasil'])) {
    $id_rm = $_POST['id_rm'];
    $nip_dokter = $_POST['nip_dokter'];
    $ICD_10 = $_POST['ICD_10'];
    $keterangan_hasil = $_POST['keterangan_hasil'];
    $nama_penyakit = $_POST['nama_penyakit'];
    $resep_obat = $_POST['resep_obat'];

    $query = "UPDATE rekam_medis SET ICD_10='$ICD_10', nama_penyakit='$nama_penyakit', resep_obat='$resep_obat', 
    nip_dokter='$nip_dokter', keterangan_hasil='$keterangan_hasil' WHERE id_rm='$id_rm'";

    $hasil = mysqli_query($conn, $query);
    if ($hasil) {
        echo "<script> alert('Proses edit berhasil'); window.location='detail-hp.php?id_rm=$id_rm';</script>";
    } else {
        echo "<script> alert('Proses edit gagal'); window.location='detail-hp.php?id_rm=$id_rm';</script>";
    }
}

//Delete Hasil
if (isset($_POST['hapushasil'])) {
    $id_rm = $_POST['id_rm'];

    $hapus = mysqli_query($conn, "DELETE FROM rekam_medis where id_rm='$id_rm'");
    if ($hapus) {
        echo "<script> alert('Proses Hapus Data Berhasil'); window.location='tabel-hp.php';</script>";
    } else {
        echo "<script> alert('Proses Hapus Data Gagal')</script>";
        header('location:tabel-hp.php');
    }
}
