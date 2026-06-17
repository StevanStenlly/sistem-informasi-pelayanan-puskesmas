<?php
session_name("ADMIN_SESSION");
session_start();
include '../../koneksi.php';
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

// Validasi login admin
if ($_SESSION['role'] !== 'admin' || empty($_SESSION['admin_id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Akses ditolak']);
    exit();
}

$chart = isset($_GET['chart']) ? $_GET['chart'] : '';
$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

$bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

// === 1. Grafik Kunjungan Pasien per Bulan (Line Chart per Jenis Kelamin) ===
if ($chart === 'kunjungan') {
    $maleData = array_fill(0, 12, 0);
    $femaleData = array_fill(0, 12, 0);
    $start = "$year-01-01";
    $end = "$year-12-31";

    $query = "
        SELECT MONTH(rm.tgl_pemeriksaan) AS bulan, p.jk_pasien, COUNT(*) AS jumlah
        FROM rekam_medis rm
        JOIN pasien p ON rm.nik_pasien = p.nik_pasien
        WHERE rm.tgl_pemeriksaan BETWEEN '$start' AND '$end'
        GROUP BY bulan, p.jk_pasien
        ORDER BY bulan
    ";

    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $index = (int)$row['bulan'] - 1;
        $jk = $row['jk_pasien'];
        $jumlah = (int)$row['jumlah'];

        if ($jk === 'Laki-Laki') {
            $maleData[$index] += $jumlah;
        } elseif ($jk === 'Perempuan') {
            $femaleData[$index] += $jumlah;
        }
    }

    echo json_encode([
        'labels' => $bulanLabels,
        'male_data' => $maleData,
        'female_data' => $femaleData
    ]);
    exit();
}

// === 2. Grafik Distribusi Usia Pasien (Bar Chart per Jenis Kelamin) ===
if ($chart === 'usia') {
    $usiaLabels = ['0-17', '18-35', '36-50', '51-65', '66+'];
    $maleData = [0, 0, 0, 0, 0];
    $femaleData = [0, 0, 0, 0, 0];
    $start = "$year-01-01";
    $end = "$year-12-31";

    $query = "
    SELECT 
        CASE 
            WHEN umur <= 17 THEN '0-17' 
            WHEN umur <= 35 THEN '18-35' 
            WHEN umur <= 50 THEN '36-50' 
            WHEN umur <= 65 THEN '51-65' 
            ELSE '66+' 
        END AS usia_group,
        p.jk_pasien,
        COUNT(DISTINCT rm.nik_pasien) AS jumlah
    FROM rekam_medis rm
    JOIN pasien p ON rm.nik_pasien = p.nik_pasien
    WHERE rm.tgl_pemeriksaan BETWEEN '$start' AND '$end'
    GROUP BY usia_group, p.jk_pasien
";

    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $group = $row['usia_group'];
        $jk = $row['jk_pasien'];
        $jumlah = (int)$row['jumlah'];
        $index = array_search($group, $usiaLabels);

        if ($index !== false) {
            if ($jk === 'Laki-Laki') {
                $maleData[$index] += $jumlah;
            } elseif ($jk === 'Perempuan') {
                $femaleData[$index] += $jumlah;
            }
        }
    }

    echo json_encode([
        'labels' => $usiaLabels,
        'male_data' => $maleData,
        'female_data' => $femaleData
    ]);
    exit();
}

// === Jika parameter chart tidak valid ===
http_response_code(400);
echo json_encode(['error' => 'Parameter chart tidak valid']);
exit();
