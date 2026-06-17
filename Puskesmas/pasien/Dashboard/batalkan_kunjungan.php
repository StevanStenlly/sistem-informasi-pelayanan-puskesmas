<?php
session_name("PASIEN_SESSION");
session_start();
include "../../koneksi.php";

if ($_SESSION['role'] !== 'pasien' || empty($_SESSION['pasien_nik'])) {
    echo "<script> window.location = '../login/login-pasien.php' </script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_rm'])) {
    $id_rm = mysqli_real_escape_string($conn, $_POST['id_rm']);
    $nik_pasien = $_SESSION['pasien_nik'];

    // Pastikan hanya data pasien sendiri dan belum diperiksa
    $cek = mysqli_query($conn, "SELECT * FROM rekam_medis WHERE id_rm='$id_rm' AND nik_pasien='$nik_pasien' AND status_dokter='Belum Diperiksa'");
    if (mysqli_num_rows($cek) > 0) {
        mysqli_query($conn, "DELETE FROM rekam_medis WHERE id_rm='$id_rm'");
        echo "<script>alert('Jadwal kunjungan berhasil dibatalkan'); window.location='index.php'</script>";
    } else {
        echo "<script>alert('Tidak dapat membatalkan. Jadwal sudah diperiksa atau tidak ditemukan'); window.location='index.php'</script>";
    }
} else {
    echo "<script>window.location='index.php'</script>";
}
