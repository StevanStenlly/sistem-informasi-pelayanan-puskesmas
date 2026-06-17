<?php
session_name("ADMIN_SESSION");
session_start();
include "../../koneksi.php";

$id = trim($_POST['id_admin']);
$password = trim($_POST['password_admin']);

// Cek berdasarkan ID
$query = mysqli_prepare($conn, "SELECT * FROM admin WHERE id_admin = ?");
mysqli_stmt_bind_param($query, "s", $id);
mysqli_stmt_execute($query);
$result = mysqli_stmt_get_result($query);

if ($data = mysqli_fetch_assoc($result)) {
    // Jika masih menggunakan password plaintext:
    if ($password === $data['password_admin']) {

        // ✅ Clear session sebelumnya untuk menghindari bentrok antar role
        session_unset();

        // Simpan session khusus role admin
        $_SESSION['role'] = 'admin';
        $_SESSION['admin_id'] = $data['id_admin'];
        $_SESSION['admin_username'] = $data['username_admin'];
        $_SESSION['admin_foto'] = $data['foto_admin'];

        echo "<script>window.location = '../Dashboard/index.php';</script>";
    } else {
        echo "<script>alert('Password tidak sesuai.'); window.location='login-admin.php';</script>";
    }
} else {
    echo "<script>alert('Username tidak ditemukan.'); window.location='login-admin.php';</script>";
}
