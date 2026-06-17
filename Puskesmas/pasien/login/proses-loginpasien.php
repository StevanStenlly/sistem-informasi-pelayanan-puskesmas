<?php
session_name("PASIEN_SESSION");
session_start();
include "../../koneksi.php";

$nip = trim($_POST['nik_pasien']);
$password = trim($_POST['password_pasien']);

// Cek berdasarkan NIP
$query = mysqli_prepare($conn, "SELECT * FROM pasien WHERE nik_pasien = ?");
mysqli_stmt_bind_param($query, "s", $nip);
mysqli_stmt_execute($query);
$result = mysqli_stmt_get_result($query);

if ($data = mysqli_fetch_assoc($result)) {
    // Jika masih menggunakan password plaintext:
    if ($password === $data['password_pasien']) {

        // ✅ Clear session sebelumnya untuk menghindari bentrok antar role
        session_unset();

        // Simpan session khusus role apoteker
        $_SESSION['role'] = 'pasien';
        $_SESSION['pasien_nik'] = $data['nik_pasien'];
        $_SESSION['pasien_nama'] = $data['nama_pasien'];
        $_SESSION['pasien_foto'] = $data['foto_pasien'];

        echo "<script>window.location = '../Dashboard/index.php';</script>";
    } else {
        echo "<script>alert('Password tidak sesuai.'); window.location='login-pasien.php';</script>";
    }
} else {
    echo "<script>alert('NIK tidak ditemukan.'); window.location='login-pasien.php';</script>";
}
