<?php
session_name("APOTEKER_SESSION");
session_start();
include "../../koneksi.php";

$nip = trim($_POST['nip_petugas']);
$password = trim($_POST['password_petugas']);

// Cek berdasarkan NIP
$query = mysqli_prepare($conn, "SELECT * FROM petugas WHERE nip_petugas = ?");
mysqli_stmt_bind_param($query, "s", $nip);
mysqli_stmt_execute($query);
$result = mysqli_stmt_get_result($query);

if ($data = mysqli_fetch_assoc($result)) {
    // Jika masih menggunakan password plaintext:
    if ($password === $data['password_petugas']) {

        // ✅ Clear session sebelumnya untuk menghindari bentrok antar role
        session_unset();

        // Simpan session khusus role apoteker
        $_SESSION['role'] = 'apoteker';
        $_SESSION['apoteker_nip'] = $data['nip_petugas'];
        $_SESSION['apoteker_nama'] = $data['nama_petugas'];
        $_SESSION['apoteker_foto'] = $data['foto_petugas'];
        $_SESSION['ruang_id'] = $data['id_ruang'];

        echo "<script>window.location = '../Dashboard/index.php';</script>";
    } else {
        echo "<script>alert('Password tidak sesuai.'); window.location='login-petugas.php';</script>";
    }
} else {
    echo "<script>alert('NIP tidak ditemukan.'); window.location='login-petugas.php';</script>";
}
