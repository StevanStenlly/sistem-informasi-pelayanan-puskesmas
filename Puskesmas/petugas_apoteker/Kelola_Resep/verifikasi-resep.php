<?php
session_name("APOTEKER_SESSION");
session_start();
include '../../koneksi.php';

if ($_SESSION['role'] !== 'apoteker' || empty($_SESSION['apoteker_nip'])) {
    echo "<script>window.location = '../login/login-petugas.php';</script>";
    exit();
}

// Hanya boleh diakses via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['beri_semua_obat'])) {
    echo "<script>alert('Akses tidak sah!'); window.location='daftar-resep.php';</script>";
    exit();
}

$id_rm = $_POST['id_rm'];
$nip = $_SESSION['apoteker_nip'];
$nama = $_SESSION['apoteker_nama'];

$conn->autocommit(false);
$sukses = true;

try {
    $resep_query = mysqli_query($conn, "SELECT id_resep FROM resep_obat WHERE id_rm='$id_rm' AND status='belum'");
    if (!$resep_query) {
        throw new Exception("Gagal mengambil data resep");
    }

    $update = mysqli_query($conn, "UPDATE resep_obat SET status='sudah' WHERE id_rm='$id_rm' AND status='belum'");
    if (!$update) {
        throw new Exception("Gagal memperbarui status resep");
    }

    $stmt = $conn->prepare("INSERT INTO distribusi_obat (id_resep, nip_petugas) VALUES (?, ?)");
    if (!$stmt) {
        throw new Exception("Gagal menyiapkan query distribusi");
    }

    while ($row = mysqli_fetch_assoc($resep_query)) {
        $id_resep = $row['id_resep'];
        $stmt->bind_param("is", $id_resep, $nip);
        if (!$stmt->execute()) {
            throw new Exception("Gagal menyimpan distribusi obat untuk resep ID: $id_resep");
        }
    }

    $stmt->close();
    $conn->commit();
    $conn->autocommit(true);

    echo "<script>alert('Semua resep untuk pasien ini telah berhasil diberikan.'); window.location='daftar-resep.php';</script>";
    exit();
} catch (Exception $e) {
    $conn->rollback();
    $conn->autocommit(true);
    $error_message = addslashes($e->getMessage()); // ← amankan kutipan tunggal
    echo "<script>alert('Gagal memberikan resep: $error_message'); window.location='daftar-resep.php';</script>";
    exit();
}
