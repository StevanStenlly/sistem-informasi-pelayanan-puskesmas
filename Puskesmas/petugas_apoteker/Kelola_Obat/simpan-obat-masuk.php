<?php
session_name("APOTEKER_SESSION");
session_start();
include "../../koneksi.php";

// ✅ Cek apakah sudah login sebagai apoteker
if ($_SESSION['role'] !== 'apoteker' || empty($_SESSION['apoteker_nip'])) {
    echo "<script> window.location = '../login/login-petugas.php' </script>";
    exit();
}

// Ambil data dari form
$kode_obat      = $_POST['kode_obat'];
$jumlah_masuk   = $_POST['jumlah_masuk'];
$tgl_kadaluarsa = $_POST['tgl_kadaluarsa'];

// Ambil data apoteker dari session
$nip_apoteker   = $_SESSION['apoteker_nip'];
$nama_apoteker  = $_SESSION['apoteker_nama'];

// Simpan ke tabel obat_masuk
$insert = mysqli_query($conn, "INSERT INTO obat_masuk (kode_obat, jumlah_masuk, nip_petugas) 
    VALUES ('$kode_obat', '$jumlah_masuk', '$nip_apoteker')");

// Jika berhasil, update stok
if ($insert) {
    mysqli_query($conn, "UPDATE obat 
    SET stok_obat = stok_obat + $jumlah_masuk, 
        tgl_kadaluarsa = '$tgl_kadaluarsa' 
    WHERE kode_obat = '$kode_obat'");

    echo "<script>alert('Data obat masuk berhasil disimpan.'); window.location.href='tabel-obat.php';</script>";
} else {
    echo "<script>alert('Gagal menyimpan data obat masuk.'); window.history.back();</script>";
}
