<?php
session_start();
require_once('../../koneksi.php');

if (!isset($_SESSION['screening_nip'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Anda tidak memiliki akses']);
    exit();
}

// Ambil tanggal filter (jika ada)
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

// Query gejala dengan filter tanggal
$query = "SELECT 
            SUM(nyeri_telan = 'Ya') AS nyeri_telan, 
            SUM(demam = 'Ya') AS demam, 
            SUM(batuk = 'Ya') AS batuk, 
            SUM(pilek = 'Ya') AS pilek 
          FROM rekam_medis";

// Tambahkan filter tanggal jika ada
if ($start_date && $end_date) {
    $query .= " WHERE tgl_pemeriksaan BETWEEN '$start_date' AND '$end_date'";
}

$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

header('Content-Type: application/json');
echo json_encode($data);
