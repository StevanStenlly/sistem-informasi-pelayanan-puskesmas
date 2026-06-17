<?php
session_name("DOKTER_SESSION");
session_start();
include "../../koneksi.php";

$nip = trim($_POST['nip_dokter']);
$password = trim($_POST['password_dokter']);

// Cek berdasarkan NIP
$query = mysqli_prepare($conn, "SELECT * FROM dokter WHERE nip_dokter = ?");
mysqli_stmt_bind_param($query, "s", $nip);
mysqli_stmt_execute($query);
$result = mysqli_stmt_get_result($query);

if ($data = mysqli_fetch_assoc($result)) {
    // Jika masih menggunakan password plaintext:
    if ($password === $data['password_dokter']) {

        // ✅ Clear session sebelumnya untuk menghindari bentrok antar role
        session_unset();

        // Simpan session khusus role dokter
        $_SESSION['role'] = 'dokter';
        $_SESSION['dokter_nip'] = $data['nip_dokter'];
        $_SESSION['dokter_nama'] = $data['nama_dokter'];
        $_SESSION['dokter_foto'] = $data['foto_dokter'];
        $_SESSION['ruang_id'] = $data['id_ruang'];

        echo "<script>window.location = '../Dashboard/index.php';</script>";
    } else {
        echo "<script>alert('Password tidak sesuai.'); window.location='login-dokter.php';</script>";
    }
} else {
    echo "<script>alert('NIP tidak ditemukan.'); window.location='login-dokter.php';</script>";
}
