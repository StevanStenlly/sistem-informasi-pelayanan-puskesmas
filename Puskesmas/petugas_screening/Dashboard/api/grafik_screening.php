<?php
session_name("SCREENING_SESSION");
session_start();
require_once('../../koneksi.php');

if ($_SESSION['role'] !== 'screening' || empty($_SESSION['screening_nip'])) {
    echo "<script> window.location = '../login/login-petugas.php' </script>";
    exit();
}

if (!$conn) {
    http_response_code(500);
    echo json_encode(['error' => 'Gagal terhubung ke database']);
    exit();
}

$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');
$start_date = "$year-01-01";
$end_date = "$year-12-31";

$data = [];

// Grafik screening berdasarkan jenis kelamin
$query = "
    SELECT MONTH(rm.tgl_pemeriksaan) AS bulan,
           SUM(p.jk_pasien = 'Laki-laki') AS laki_laki,
           SUM(p.jk_pasien = 'Perempuan') AS perempuan
    FROM rekam_medis rm
    JOIN pasien p ON rm.nik_pasien = p.nik_pasien
    WHERE rm.tgl_pemeriksaan BETWEEN ? AND ?
    GROUP BY MONTH(rm.tgl_pemeriksaan)
    ORDER BY bulan ASC
";

$stmt = $conn->prepare($query);
$stmt->bind_param('ss', $start_date, $end_date);
$stmt->execute();
$result = $stmt->get_result();

$bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
$maleData = array_fill(0, 12, 0);
$femaleData = array_fill(0, 12, 0);

while ($row = $result->fetch_assoc()) {
    $index = (int)$row['bulan'] - 1;
    $maleData[$index] = (int)$row['laki_laki'];
    $femaleData[$index] = (int)$row['perempuan'];
}

$data['screening'] = [
    'labels' => $bulanLabels,
    'male_data' => $maleData,
    'female_data' => $femaleData
];

// Grafik gejala
$query = "SELECT 
            SUM(nyeri_telan = 'Ya') AS nyeri_telan, 
            SUM(demam = 'Ya') AS demam, 
            SUM(batuk = 'Ya') AS batuk, 
            SUM(pilek = 'Ya') AS pilek
          FROM rekam_medis 
          WHERE tgl_pemeriksaan BETWEEN ? AND ?";

$stmt = $conn->prepare($query);
$stmt->bind_param('ss', $start_date, $end_date);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$data['gejala'] = [
    'labels' => ['Nyeri Telan', 'Demam', 'Batuk', 'Pilek'],
    'data' => [
        (int)$row['nyeri_telan'],
        (int)$row['demam'],
        (int)$row['batuk'],
        (int)$row['pilek']
    ]
];

header('Content-Type: application/json');
echo json_encode($data);
exit();
