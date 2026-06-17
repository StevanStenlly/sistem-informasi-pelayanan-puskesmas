<?php
session_start();
require_once('../../koneksi.php');

// Validasi Login
if (!isset($_SESSION['screening_nip'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Anda tidak memiliki akses']);
    exit();
}

// Memastikan koneksi database berhasil
if (!$conn) {
    http_response_code(500);
    echo json_encode(['error' => 'Gagal terhubung ke database']);
    exit();
}

// Query untuk memeriksa pasien baru (data dalam 1 jam terakhir)
$query = "
    SELECT p.nik_pasien, p.nama_pasien, 
           CONCAT(rm.tgl_pemeriksaan, ' ', rm.waktu_pemeriksaan) AS tanggal_waktu 
    FROM rekam_medis rm 
    JOIN pasien p ON rm.nik_pasien = p.nik_pasien
    WHERE CONCAT(rm.tgl_pemeriksaan, ' ', rm.waktu_pemeriksaan) >= NOW() - INTERVAL 1 HOUR 
    ORDER BY rm.tgl_pemeriksaan DESC, rm.waktu_pemeriksaan DESC
";

// Mengeksekusi Query
$result = mysqli_query($conn, $query);

// Memastikan Query Berhasil
if (!$result) {
    http_response_code(500);
    echo json_encode(['error' => 'Gagal mengambil data pasien baru']);
    exit();
}

$new_patients = [];
while ($row = mysqli_fetch_assoc($result)) {
    $new_patients[] = $row;
}

// Mengembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode(['new_patients' => $new_patients]);
