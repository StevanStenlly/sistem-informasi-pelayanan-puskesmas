<?php
require_once '../../koneksi.php';

// Tambah obat baru
if (isset($_POST['addnewobat'])) {
    $kode_obat = trim($_POST['kode_obat']);
    $nama_obat = trim($_POST['nama_obat']);
    $dosis_obat = trim($_POST['dosis_obat']);
    $satuan = trim($_POST['satuan']);
    $stok_obat = (int) $_POST['stok_obat'];
    $tgl_kadaluarsa = !empty($_POST['tgl_kadaluarsa']) ? $_POST['tgl_kadaluarsa'] : null;
    $keterangan_obat = trim($_POST['keterangan_obat']);

    $stmt = $conn->prepare("INSERT INTO obat (kode_obat, nama_obat, dosis_obat, satuan, stok_obat, tgl_kadaluarsa, keterangan_obat) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiss", $kode_obat, $nama_obat, $dosis_obat, $satuan, $stok_obat, $tgl_kadaluarsa, $keterangan_obat);

    if ($stmt->execute()) {
        echo "<script>window.location='tabel-obat.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan obat'); history.back();</script>";
    }
    $stmt->close();
}

// Kurangi stok obat saat diberikan ke pasien
if (isset($_POST['keluar_obat'])) {
    $kode_obat = trim($_POST['kode_obat']);
    $jumlah_keluar = (int) $_POST['jumlah_keluar'];
    $nip_apoteker = $_SESSION['apoteker_nip']; // Mendapatkan NIP Apoteker dari session

    // Cek stok tersedia
    $check = $conn->prepare("SELECT stok_obat FROM obat WHERE kode_obat = ?");
    $check->bind_param("s", $kode_obat);
    $check->execute();
    $check->bind_result($stok_sekarang);
    $check->fetch();
    $check->close();

    if ($stok_sekarang >= $jumlah_keluar) {
        // Kurangi stok obat
        $stmt = $conn->prepare("UPDATE obat SET stok_obat = stok_obat - ? WHERE kode_obat = ?");
        $stmt->bind_param("is", $jumlah_keluar, $kode_obat);
        if ($stmt->execute()) {
            // Insert data distribusi obat
            $tgl_distribusi = date('Y-m-d');  // Tanggal distribusi saat ini
            $waktu_distribusi = date('H:i');  // Waktu distribusi saat ini
            $stmtDistribusi = $conn->prepare("INSERT INTO distribusi_obat (id_resep, tgl_distribusi, waktu_distribusi, nip_apoteker) 
                                              VALUES (?, ?, ?, ?)");
            $stmtDistribusi->bind_param("isss", $_POST['id_resep'], $tgl_distribusi, $waktu_distribusi, $nip_apoteker);
            if ($stmtDistribusi->execute()) {
                echo "<script>alert('Stok berhasil dikurangi dan distribusi obat tercatat'); window.location='tabel-obat.php';</script>";
            } else {
                echo "<script>alert('Gagal mencatat distribusi obat'); history.back();</script>";
            }
            $stmtDistribusi->close();
        } else {
            echo "<script>alert('Gagal mengurangi stok'); history.back();</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Stok tidak mencukupi'); history.back();</script>";
    }
}
