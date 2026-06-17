<?php
session_name("APOTEKER_SESSION");
session_start();
include '../../koneksi.php';
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

header('Content-Type: application/json');

if ($_SESSION['role'] !== 'apoteker' || empty($_SESSION['apoteker_nip']) || $_SESSION['ruang_id'] != 6) {
    echo json_encode(['error' => 'Akses tidak diizinkan.']);
    exit;
}

$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
$tgl_awal = "$tahun-01-01";
$tgl_akhir = "$tahun-12-31";

// Total obat (semua data di tabel stok_obat)
$query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM stok_obat");
$total_obat = mysqli_fetch_assoc($query)['total'] ?? 0;

// Total jenis obat unik
$query = mysqli_query($conn, "SELECT COUNT(DISTINCT nama_obat) AS total FROM stok_obat");
$total_jenis = mysqli_fetch_assoc($query)['total'] ?? 0;

// Total stok tersedia
$query = mysqli_query($conn, "SELECT SUM(stok) AS total FROM stok_obat");
$stok_tersedia = mysqli_fetch_assoc($query)['total'] ?? 0;

// Jumlah resep yang didistribusikan dalam tahun
$query = mysqli_query($conn, "
    SELECT COUNT(DISTINCT id_resep) AS total
    FROM distribusi_obat d
    JOIN petugas p ON d.nip_petugas = p.nip_petugas
    WHERE p.id_ruang = 6
    AND d.tgl_distribusi BETWEEN '$tgl_awal' AND '$tgl_akhir'
");
$total_resep = mysqli_fetch_assoc($query)['total'] ?? 0;

// Jumlah distribusi hari ini
$today = date('Y-m-d');
$query = mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM distribusi_obat d
    JOIN petugas p ON d.nip_petugas = p.nip_petugas
    WHERE p.id_ruang = 6
    AND d.tgl_distribusi = '$today'
");
$distribusi_hari_ini = mysqli_fetch_assoc($query)['total'] ?? 0;

// Output
echo json_encode([
    'total_obat' => $total_obat,
    'total_jenis' => $total_jenis,
    'stok_tersedia' => $stok_tersedia,
    'total_resep' => $total_resep,
    'distribusi_hari_ini' => $distribusi_hari_ini
]);
exit;
