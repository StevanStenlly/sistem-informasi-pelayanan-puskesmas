<?php
require '../../koneksi.php';

//Menambah data pasien
if (isset($_POST['addnewpasien'])) {

    $foto_pasien = $_POST['foto_pasien'];
    $nama_pasien = $_POST['nama_pasien'];
    $nik_pasien = $_POST['nik_pasien'];
    $password_pasien = $_POST['password_pasien'];
    $no_hp_pasien = $_POST['no_hp_pasien'];
    $bpjs = $_POST['bpjs'];

    $cek_nik = mysqli_query($conn, "SELECT * FROM pasien WHERE nik_pasien = '$nik_pasien'");
    if (mysqli_num_rows($cek_nik) > 0) {
        echo "<script>alert('NIK sudah terdaftar.'); history.back();</script>";
        exit;
    }

    $query = mysqli_query($conn, "INSERT into pasien (nik_pasien, nama_pasien, foto_pasien, no_hp_pasien, password_pasien, bpjs) VALUES 
    ('$nik_pasien', '$nama_pasien', '$foto_pasien', '$no_hp_pasien', '$password_pasien', '$bpjs')");

    if ($query) {
        echo "<script> alert('Proses buat Akun berhasil'); window.location='login-pasien.php';</script>";
    } else {
        echo "<script> alert('Proses buat akun gagal'); history.back();</script>";
    }
}
