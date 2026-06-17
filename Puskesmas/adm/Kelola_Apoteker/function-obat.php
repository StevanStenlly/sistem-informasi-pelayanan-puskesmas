<?php
require '../../koneksi.php';

//Menambah data obat
if (isset($_POST['addnewobat'])) {
    $nama_obat = $_POST['nama_obat'];
    $dosis_obat = $_POST['dosis_obat'];
    $keterangan_obat = $_POST['keterangan_obat'];

    $query = mysqli_query($conn, "INSERT into obat (nama_obat, dosis_obat, keterangan_obat) VALUES ('$nama_obat', '$dosis_obat', '$keterangan_obat')");

    if ($query) {
        echo "<script> window.location='tabel-obat.php';</script>";
    } else {
        echo "<script> alert('Proses tambah Obat gagal'); history.back();</script>";
    }
}


//Update Data obat
$ambilsemuaobat = mysqli_query($conn, "SELECT * FROM obat");

$data = mysqli_fetch_array($ambilsemuaobat);

if (isset($_POST['updateobat'])) {
    $ido = $_POST['ido'];
    $nama_obat = $_POST['nama_obat'];
    $dosis_obat = $_POST['dosis_obat'];
    $keterangan_obat = $_POST['keterangan_obat'];

    $query = "UPDATE obat SET nama_obat='$nama_obat', dosis_obat='$dosis_obat', keterangan_obat='$keterangan_obat' WHERE kode_obat='$ido'";

    $hasil = mysqli_query($conn, $query);
    if ($hasil) {
        echo "<script> alert('Proses edit Obat berhasil'); window.location='tabel-obat.php';</script>";
    } else {
        echo "<script> alert('Proses edit Obat gagal'); window.location='tabel-obat.php';</script>";
    }
}



//Delete obat
if (isset($_POST['hapusobat'])) {
    $ido = $_POST['ido'];

    $hapus = mysqli_query($conn, "DELETE FROM obat where kode_obat='$ido'");
    if ($hapus) {
        echo "<script> alert('Proses Hapus Data Obat Berhasil'); window.location='tabel-obat.php';</script>";
    } else {
        echo "<script> alert('Proses Hapus Data Obat Gagal')</script>";
        header('location:tabel-obat.php');
    }
}
