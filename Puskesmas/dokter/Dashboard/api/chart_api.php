<?php
session_name("DOKTER_SESSION");
session_start();
include '../../koneksi.php';
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

// Validasi Login Dokter
if ($_SESSION['role'] !== 'dokter' || empty($_SESSION['dokter_nip'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Akses ditolak']);
    exit();
}

$id_ruang = $_SESSION['ruang_id'];
$nip_dokter = $_SESSION['dokter_nip'];

$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');
$start_date = "$year-01-01";
$end_date = "$year-12-31";

$data = [];

// ===== Grafik Kunjungan Pasien Berdasarkan Jenis Kelamin per Bulan (per ruang) =====
$query = "
    SELECT MONTH(rm.tgl_pemeriksaan) AS bulan,
           SUM(p.jk_pasien = 'Laki-Laki') AS laki_laki,
           SUM(p.jk_pasien = 'Perempuan') AS perempuan
    FROM rekam_medis rm
    JOIN pasien p ON rm.nik_pasien = p.nik_pasien
    WHERE rm.tgl_pemeriksaan BETWEEN ? AND ?
      AND rm.id_ruang = ?
    GROUP BY MONTH(rm.tgl_pemeriksaan)
    ORDER BY bulan ASC
";

$stmt = $conn->prepare($query);
$stmt->bind_param('ssi', $start_date, $end_date, $id_ruang);
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

$data['kunjungan'] = [
    'labels' => $bulanLabels,
    'male_data' => $maleData,
    'female_data' => $femaleData
];

// ===== Grafik Top 10 Diagnosa Terbanyak (per ruang, per dokter, per tahun) =====
$queryDiagnosa = "
    SELECT nama_penyakit, COUNT(*) AS jumlah
    FROM rekam_medis
    WHERE YEAR(tgl_pemeriksaan) = ?
      AND id_ruang = ?
      AND nip_dokter = ?
      AND nama_penyakit != ''
    GROUP BY nama_penyakit
    ORDER BY jumlah DESC
    LIMIT 10
";

$stmtDiagnosa = $conn->prepare($queryDiagnosa);
$stmtDiagnosa->bind_param('iis', $year, $id_ruang, $nip_dokter);
$stmtDiagnosa->execute();
$resultDiagnosa = $stmtDiagnosa->get_result();

$labels = [];
$diagnosaData = [];

while ($row = $resultDiagnosa->fetch_assoc()) {
    $labels[] = $row['nama_penyakit'];
    $diagnosaData[] = (int)$row['jumlah'];
}

$data['diagnosa'] = [
    'labels' => $labels,
    'data' => $diagnosaData
];

// Output JSON
header('Content-Type: application/json');
echo json_encode($data);
exit();
