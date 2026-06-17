<?php
require '../../koneksi.php';

//Update Data Hasil Pemeriksaan
$ambilsemuahasil = mysqli_query($conn, "SELECT * FROM hasil_pemeriksaan a left join dokter b on a.nip_dokter=b.nip_dokter");

$data = mysqli_fetch_array($ambilsemuahasil);

if (isset($_POST['updatehasil'])) {
    $id_hasil = $_POST['id_hasil'];
    $nip_dokter = $_POST['nip_dokter'];
    $ICD_10 = $_POST['ICD_10'];
    $keterangan_hasil = $_POST['keterangan_hasil'];
    $nama_penyakit = $_POST['nama_penyakit'];
    $resep_obat = $_POST['resep_obat'];

    $query = "UPDATE hasil_pemeriksaan SET ICD_10='$ICD_10', nama_penyakit='$nama_penyakit', resep_obat='$resep_obat', 
    nip_dokter='$nip_dokter', keterangan_hasil='$keterangan_hasil' WHERE id_hasil='$id_hasil'";

    $hasil = mysqli_query($conn, $query);
    if ($hasil) {
        echo "<script> alert('Proses edit berhasil'); window.location='detail-hp.php?id_hasil=$id_hasil';</script>";
    } else {
        echo "<script> alert('Proses edit gagal'); window.location='detail-hp.php?id_hasil=$id_hasil';</script>";
    }
}

//Delete Hasil
if (isset($_POST['hapushasil'])) {
    $id_hasil = $_POST['id_hasil'];

    $hapus = mysqli_query($conn, "DELETE FROM hasil_pemeriksaan where id_hasil='$id_hasil'");
    if ($hapus) {
        echo "<script> alert('Proses Hapus Data Berhasil'); window.location='tabel-hp.php';</script>";
    } else {
        echo "<script> alert('Proses Hapus Data Gagal')</script>";
        header('location:tabel-hp.php');
    }
}
