<?php
session_name("SCREENING_SESSION");
session_start();
require_once('../../koneksi.php');

// Validasi Login
if ($_SESSION['role'] !== 'screening' || empty($_SESSION['screening_nip'])) {
    echo "<script> window.location = '../login/login-petugas.php' </script>";
    exit();
}

// Memastikan koneksi database berhasil
if (!$conn) {
    http_response_code(500);
    echo json_encode(['error' => 'Gagal terhubung ke database']);
    exit();
}

// Query untuk memeriksa pasien baru (Belum Diperiksa)
$query = "
    SELECT p.nik_pasien, p.nama_pasien, 
           CONCAT(rm.tgl_pemeriksaan, ' ', rm.waktu_pemeriksaan) AS tanggal_waktu 
    FROM rekam_medis rm 
    JOIN pasien p ON rm.nik_pasien = p.nik_pasien
    WHERE rm.status_screening = 'Belum Diperiksa'
    ORDER BY rm.tgl_pemeriksaan DESC, rm.waktu_pemeriksaan DESC
    LIMIT 20;
";

// Mengeksekusi Query
$result = mysqli_query($conn, $query);
$new_patients = [];

while ($row = mysqli_fetch_assoc($result)) {
    $new_patients[] = $row;
}

// Mengembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode(['new_patients' => $new_patients]);
exit();
