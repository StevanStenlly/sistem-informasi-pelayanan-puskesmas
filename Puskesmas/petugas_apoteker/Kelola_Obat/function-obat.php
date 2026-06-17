<?php
require '../../koneksi.php';

// Menambah data obat
if (isset($_POST['addnewobat'])) {
    // Ambil kode_obat terakhir
    $cekKode = mysqli_query($conn, "SELECT MAX(kode_obat) as maxKode FROM obat");
    $dataKode = mysqli_fetch_assoc($cekKode);
    $lastKode = $dataKode['maxKode'];

    // Ambil angka dari format 'OBT-0005' → jadi 5
    $urutan = (int) substr($lastKode, 4);
    $urutan++;

    // Format ulang jadi 'OBT-0006'
    $kode_obat = 'OBT-' . str_pad($urutan, 4, '0', STR_PAD_LEFT);

    // Ambil data dari form
    $nama_obat = trim($_POST['nama_obat']);
    $dosis_obat = trim($_POST['dosis_obat']);
    $satuan = trim($_POST['satuan']);
    $stok_obat = (int) $_POST['stok_obat'];
    $minimum_stok = (int) $_POST['minimum_stok']; // ← Tambahan baru
    $keterangan_obat = trim($_POST['keterangan_obat']);
    $tgl_kadaluarsa = !empty($_POST['tgl_kadaluarsa']) ? $_POST['tgl_kadaluarsa'] : null;

    $stmt = $conn->prepare("INSERT INTO obat (kode_obat, nama_obat, dosis_obat, satuan, stok_obat, minimum_stok, tgl_kadaluarsa, keterangan_obat) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiiss", $kode_obat, $nama_obat, $dosis_obat, $satuan, $stok_obat, $minimum_stok, $tgl_kadaluarsa, $keterangan_obat);

    if ($stmt->execute()) {
        echo "<script>window.location='tabel-obat.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan obat'); history.back();</script>";
    }
    $stmt->close();
}

// Update data obat
if (isset($_POST['updateobat'])) {
    $ido = $_POST['ido'];
    $kode_obat = trim($_POST['kode_obat']);
    $nama_obat = trim($_POST['nama_obat']);
    $dosis_obat = trim($_POST['dosis_obat']);
    $satuan = trim($_POST['satuan']);
    $keterangan_obat = trim($_POST['keterangan_obat']);
    $stok_obat = (int) $_POST['stok_obat'];
    $minimum_stok = (int) $_POST['minimum_stok']; // ← Tambahan baru
    $tgl_kadaluarsa = !empty($_POST['tgl_kadaluarsa']) ? $_POST['tgl_kadaluarsa'] : null;

    $stmt = $conn->prepare("UPDATE obat SET nama_obat=?, dosis_obat=?, satuan=?, stok_obat=?, minimum_stok=?, keterangan_obat=?, tgl_kadaluarsa=? WHERE kode_obat=?");
    $stmt->bind_param("sssissss", $nama_obat, $dosis_obat, $satuan, $stok_obat, $minimum_stok, $keterangan_obat, $tgl_kadaluarsa, $ido);

    if ($stmt->execute()) {
        echo "<script>alert('Proses update Obat berhasil'); window.location='tabel-obat.php';</script>";
    } else {
        echo "<script>alert('Proses update Obat gagal'); history.back();</script>";
    }

    $stmt->close();
}

// Delete obat
if (isset($_POST['hapusobat'])) {
    $ido = $_POST['ido'];

    $hapus = mysqli_query($conn, "DELETE FROM obat WHERE kode_obat='$ido'");
    if ($hapus) {
        echo "<script>alert('Proses Hapus Data Obat Berhasil'); window.location='tabel-obat.php';</script>";
    } else {
        echo "<script>alert('Proses Hapus Data Obat Gagal'); history.back();</script>";
    }
}
