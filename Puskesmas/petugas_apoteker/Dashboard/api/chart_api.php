<?php
session_name("APOTEKER_SESSION");
session_start();
include '../../koneksi.php';
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

// Validasi Login
if ($_SESSION['role'] !== 'apoteker' || empty($_SESSION['apoteker_nip']) || $_SESSION['ruang_id'] != 6) {
    echo json_encode(['error' => 'Akses tidak diizinkan.']);
    exit;
}

$nip_apoteker = $_SESSION['apoteker_nip'];

// Ambil rentang tanggal dari parameter
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-01-01');
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-12-31');

// Data awal
$data = [];

// ==== Template Bulan Singkat ====
$bulanMap = [
    1 => 'Jan',
    2 => 'Feb',
    3 => 'Mar',
    4 => 'Apr',
    5 => 'Mei',
    6 => 'Jun',
    7 => 'Jul',
    8 => 'Agu',
    9 => 'Sep',
    10 => 'Okt',
    11 => 'Nov',
    12 => 'Des'
];
$bulanLabels = array_values($bulanMap);
$obatDikirim = array_fill(0, 12, 0);
$obatMasuk = array_fill(0, 12, 0);

// ==== Data Obat Dikirim ====
$queryDistribusi = "
    SELECT MONTH(d.tgl_distribusi) AS bulan, SUM(r.jumlah) AS total
    FROM distribusi_obat d
    JOIN resep_obat r ON d.id_resep = r.id_resep
    JOIN petugas p ON d.nip_petugas = p.nip_petugas
    WHERE p.id_ruang = 6
    AND d.tgl_distribusi BETWEEN '$start_date' AND '$end_date'
    GROUP BY bulan
    ORDER BY bulan
";
$result = mysqli_query($conn, $queryDistribusi);
while ($row = mysqli_fetch_assoc($result)) {
    $index = (int)$row['bulan'] - 1;
    $obatDikirim[$index] = (int)$row['total'];
}

// ==== Data Obat Masuk ====
$queryMasuk = "
    SELECT MONTH(o.tanggal_masuk) AS bulan, SUM(o.jumlah_masuk) AS total
    FROM obat_masuk o
    JOIN petugas p ON o.nip_petugas = p.nip_petugas
    WHERE p.id_ruang = 6
    AND o.tanggal_masuk BETWEEN '$start_date' AND '$end_date'
    GROUP BY bulan
    ORDER BY bulan
";
$result = mysqli_query($conn, $queryMasuk);
while ($row = mysqli_fetch_assoc($result)) {
    $index = (int)$row['bulan'] - 1;
    $obatMasuk[$index] = (int)$row['total'];
}

// ==== Siapkan JSON untuk Grafik ====
$data['obat'] = [
    'labels' => $bulanLabels,
    'dikirim' => $obatDikirim,
    'masuk' => $obatMasuk
];

// Output
header('Content-Type: application/json');
echo json_encode($data);
exit;
