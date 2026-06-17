<?php
include "../../koneksi.php";
// Update Data Hasil Pemeriksaan
$ambilsemuahasil = mysqli_query($conn, "SELECT * FROM rekam_medis a LEFT JOIN dokter b ON a.nip_dokter = b.nip_dokter");
$data = mysqli_fetch_array($ambilsemuahasil);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aksi']) && $_POST['aksi'] === 'tambah_obat_ajax') {
    $id_rm = (int) $_POST['id_rm'];
    $kode_obat = $_POST['kode_obat'];
    $dosis = trim($_POST['dosis']);
    $jumlah = (int) $_POST['jumlah'];

    // Cek stok dulu
    $cek = mysqli_query($conn, "SELECT stok_obat FROM obat WHERE kode_obat = '$kode_obat'");
    $data = mysqli_fetch_assoc($cek);

    if (!$data || $data['stok_obat'] < $jumlah) {
        echo json_encode(['status' => 'error', 'pesan' => 'Stok tidak mencukupi']);
        exit;
    }

    $conn->autocommit(false);

    try {
        // Simpan resep
        $stmt = $conn->prepare("INSERT INTO resep_obat (id_rm, kode_obat, dosis, jumlah) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("issi", $id_rm, $kode_obat, $dosis, $jumlah);
        if (!$stmt->execute()) {
            throw new Exception("Gagal simpan resep");
        }
        $stmt->close();

        // Kurangi stok
        $stmt2 = $conn->prepare("UPDATE obat SET stok_obat = stok_obat - ? WHERE kode_obat = ?");
        $stmt2->bind_param("is", $jumlah, $kode_obat);
        if (!$stmt2->execute()) {
            throw new Exception("Gagal update stok");
        }
        $stmt2->close();

        $conn->commit();
        echo json_encode(['status' => 'sukses', 'pesan' => 'Resep berhasil ditambahkan']);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['status' => 'error', 'pesan' => $e->getMessage()]);
    }

    $conn->autocommit(true);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aksi']) && $_POST['aksi'] === 'edit_resep_ajax') {
    $id_resep = (int) $_POST['id_resep_edit'];
    $kode_obat = $_POST['kode_obat_edit'];
    $jumlah_lama = (int) $_POST['jumlah_lama'];
    $jumlah_baru = (int) $_POST['jumlah_edit'];
    $dosis_baru = $_POST['dosis_edit'];

    $selisih = $jumlah_baru - $jumlah_lama;

    $conn->autocommit(false);
    try {
        // Cek stok bila menambah jumlah
        if ($selisih > 0) {
            $cek = mysqli_query($conn, "SELECT stok_obat FROM obat WHERE kode_obat = '$kode_obat'");
            $stok = mysqli_fetch_assoc($cek)['stok_obat'];
            if ($stok < $selisih) {
                throw new Exception("Stok tidak cukup");
            }
        }

        // Update resep
        $stmt = $conn->prepare("UPDATE resep_obat SET dosis = ?, jumlah = ? WHERE id_resep = ?");
        $stmt->bind_param("sii", $dosis_baru, $jumlah_baru, $id_resep);
        if (!$stmt->execute()) throw new Exception("Gagal update resep");
        $stmt->close();

        // Koreksi stok
        $stmt2 = $conn->prepare("UPDATE obat SET stok_obat = stok_obat - ? WHERE kode_obat = ?");
        $stmt2->bind_param("is", $selisih, $kode_obat);
        if (!$stmt2->execute()) throw new Exception("Gagal koreksi stok");
        $stmt2->close();

        $conn->commit();
        echo json_encode(['status' => 'sukses']);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['status' => 'error', 'pesan' => $e->getMessage()]);
    }

    $conn->autocommit(true);
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aksi']) && $_POST['aksi'] === 'hapus_resep_ajax') {
    $id_resep = (int) $_POST['id_resep'];
    $kode_obat = $_POST['kode_obat'];
    $jumlah = (int) $_POST['jumlah'];

    $conn->autocommit(false);
    try {
        // Kembalikan stok
        $stmt1 = $conn->prepare("UPDATE obat SET stok_obat = stok_obat + ? WHERE kode_obat = ?");
        $stmt1->bind_param("is", $jumlah, $kode_obat);
        if (!$stmt1->execute()) throw new Exception("Gagal kembalikan stok");
        $stmt1->close();

        // Hapus resep
        $stmt2 = $conn->prepare("DELETE FROM resep_obat WHERE id_resep = ?");
        $stmt2->bind_param("i", $id_resep);
        if (!$stmt2->execute()) throw new Exception("Gagal hapus resep");
        $stmt2->close();

        $conn->commit();
        echo json_encode(['status' => 'sukses']);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['status' => 'error', 'pesan' => $e->getMessage()]);
    }

    $conn->autocommit(true);
    exit;
}

if (isset($_POST['updatehasil'])) {
    $id_rm = $_POST['id_rm'];
    $nip_dokter = $_POST['nip_dokter'];
    $ICD_10 = $_POST['ICD_10'];
    $keterangan_hasil = $_POST['keterangan_hasil'];
    $nama_penyakit = $_POST['nama_penyakit'];
    $status_dokter = 'Sudah Diperiksa';

    // Update rekam_medis
    $query = "UPDATE rekam_medis SET 
    ICD_10='$ICD_10', 
    nama_penyakit='$nama_penyakit', 
    nip_dokter='$nip_dokter', 
    keterangan_hasil='$keterangan_hasil',
    status_dokter='$status_dokter'
    WHERE id_rm='$id_rm'";

    mysqli_query($conn, $query);

    // Simpan resep jika ada
    if (
        isset($_POST['kode_obat'], $_POST['jumlah'], $_POST['dosis']) &&
        $_POST['kode_obat'] !== '' &&
        $_POST['jumlah'] !== '' &&
        $_POST['dosis'] !== ''
    ) {
        $kode_obat = $_POST['kode_obat'];
        $jumlah = (int) $_POST['jumlah'];
        $dosis = $_POST['dosis'];

        $conn->autocommit(false); // Mulai transaksi

        try {
            // Simpan resep obat
            $stmt1 = $conn->prepare("INSERT INTO resep_obat (id_rm, kode_obat, dosis, jumlah) VALUES (?, ?, ?, ?)");
            $stmt1->bind_param("issi", $id_rm, $kode_obat, $dosis, $jumlah);
            if (!$stmt1->execute()) {
                echo "<script>alert('Gagal simpan resep: " . $stmt1->error . "');</script>";
                throw new Exception("Gagal menyimpan resep obat");
            }

            $stmt1->close();

            // Cek stok dulu
            $stok_check = mysqli_query($conn, "SELECT stok_obat FROM obat WHERE kode_obat = '$kode_obat'");
            $stok_data = mysqli_fetch_assoc($stok_check);
            if ($stok_data['stok_obat'] < $jumlah) {
                throw new Exception("Stok obat tidak mencukupi");
            }

            // Update stok
            $stmt2 = $conn->prepare("UPDATE obat SET stok_obat = stok_obat - ? WHERE kode_obat = ?");
            $stmt2->bind_param("is", $jumlah, $kode_obat);
            if (!$stmt2->execute()) {
                throw new Exception("Gagal mengurangi stok obat");
            }
            $stmt2->close();

            // Commit jika semua berhasil
            $conn->commit();
        } catch (Exception $e) {
            $conn->rollback(); // Batalkan semua perubahan
            echo "<script>alert('Transaksi gagal: " . $e->getMessage() . "');</script>";
        }

        $conn->autocommit(true); // Kembalikan autocommit
    }

    // Redirect (hindari form resubmit)
    header("Location: detail-hp.php?id_rm=$id_rm");
    exit();
}

// Delete Hasil
if (isset($_POST['hapushasil'])) {
    $id_rm = $_POST['id_rm'];

    $hapus = mysqli_query($conn, "DELETE FROM rekam_medis WHERE id_rm='$id_rm'");
    header("Location: tabel-hp.php");
    exit();
}

// Hapus Resep
if (isset($_POST['hapus_resep'])) {
    $id_rm = $_GET['id_rm'];
    $id_resep = $_POST['id_resep'];
    $jumlah_hapus = (int) $_POST['jumlah_hapus'];
    $kode_obat_hapus = $_POST['kode_obat_hapus'];

    $conn->autocommit(false);

    try {
        // Tambah stok kembali
        $stmt1 = $conn->prepare("UPDATE obat SET stok_obat = stok_obat + ? WHERE kode_obat = ?");
        $stmt1->bind_param("is", $jumlah_hapus, $kode_obat_hapus);
        if (!$stmt1->execute()) {
            throw new Exception("Gagal mengembalikan stok obat");
        }
        $stmt1->close();

        // Hapus resep
        $stmt2 = $conn->prepare("DELETE FROM resep_obat WHERE id_resep = ?");
        $stmt2->bind_param("i", $id_resep);
        if (!$stmt2->execute()) {
            throw new Exception("Gagal menghapus data resep");
        }
        $stmt2->close();

        $conn->commit();
    } catch (Exception $e) {
        $conn->rollback();
        echo "<script>alert('Gagal hapus resep: " . $e->getMessage() . "');</script>";
    }

    $conn->autocommit(true);
    header("Location: detail-hp.php?id_rm=$id_rm");
    exit();
}

// Edit Resep
if (isset($_POST['edit_resep'])) {
    $id_rm = $_GET['id_rm'];
    $id_resep = $_POST['id_resep_edit'];
    $jumlah_lama = (int) $_POST['jumlah_lama'];
    $jumlah_baru = (int) $_POST['jumlah_edit'];
    $dosis_baru = $_POST['dosis_edit'];
    $kode_obat = $_POST['kode_obat_edit'];

    $selisih = $jumlah_baru - $jumlah_lama;

    $conn->autocommit(false);

    try {
        // Cek stok jika mengurangi lebih banyak
        if ($selisih > 0) {
            $cek = mysqli_query($conn, "SELECT stok_obat FROM obat WHERE kode_obat = '$kode_obat'");
            $data = mysqli_fetch_assoc($cek);
            if ($data['stok_obat'] < $selisih) {
                throw new Exception("Stok tidak mencukupi untuk penyesuaian resep");
            }
        }

        // Update resep
        $stmt = $conn->prepare("UPDATE resep_obat SET dosis = ?, jumlah = ? WHERE id_resep = ?");
        $stmt->bind_param("sii", $dosis_baru, $jumlah_baru, $id_resep);
        if (!$stmt->execute()) {
            throw new Exception("Gagal update resep");
        }
        $stmt->close();

        // Update stok obat
        $stmt2 = $conn->prepare("UPDATE obat SET stok_obat = stok_obat - ? WHERE kode_obat = ?");
        $stmt2->bind_param("is", $selisih, $kode_obat);
        if (!$stmt2->execute()) {
            throw new Exception("Gagal koreksi stok obat");
        }
        $stmt2->close();

        $conn->commit();
    } catch (Exception $e) {
        $conn->rollback();
        echo "<script>alert('Transaksi gagal: " . $e->getMessage() . "');</script>";
    }

    $conn->autocommit(true);
    header("Location: detail-hp.php?id_rm=$id_rm");
    exit();
}


if (isset($_POST['simpan_rujukan'])) {
    $id_rm = $_POST['id_rm'];
    $tanggal_rujukan = $_POST['tanggal_rujukan'];
    $fasilitas_tujuan = trim($_POST['fasilitas_tujuan']);
    $poli_tujuan = trim($_POST['poli_tujuan']);
    $alasan_rujukan = trim($_POST['alasan_rujukan']);
    $diagnosa = htmlspecialchars(trim($_POST['diagnosa']));
    $ICD_10 = trim($_POST['ICD_10']);
    $nip_pengirim = $_POST['nip_pengirim'];
    $nama_pengirim = $_POST['nama_pengirim'];

    // Generate nomor surat rujukan otomatis
    $tanggal_format = date("Ymd", strtotime($tanggal_rujukan));
    $prefix = "RUJ-" . $tanggal_format . "-";

    // Cari urutan terakhir hari ini
    $cek = mysqli_query($conn, "SELECT COUNT(*) as total FROM surat_rujukan WHERE tanggal_rujukan = '$tanggal_rujukan'");
    $row = mysqli_fetch_assoc($cek);
    $urutan = str_pad($row['total'] + 1, 4, '0', STR_PAD_LEFT);
    $no_rujukan = $prefix . $urutan;

    // Insert ke DB
    $stmt = $conn->prepare("INSERT INTO surat_rujukan (id_rm, no_rujukan, tanggal_rujukan, fasilitas_tujuan, poli_tujuan, alasan_rujukan, diagnosa, ICD_10, nip_pengirim, nama_pengirim) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssssss", $id_rm, $no_rujukan, $tanggal_rujukan, $fasilitas_tujuan, $poli_tujuan, $alasan_rujukan, $diagnosa, $ICD_10, $nip_pengirim, $nama_pengirim);

    if ($stmt->execute()) {
        echo "<script>alert('Surat rujukan berhasil disimpan'); window.location='detail-hp.php?id_rm=$id_rm';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan surat rujukan'); history.back();</script>";
    }
    $stmt->close();
}
if (isset($_POST['update_rujukan'])) {
    $id_rujukan = $_POST['id_rujukan'];
    $id_rm = $_POST['id_rm'];
    $tanggal_rujukan = $_POST['tanggal_rujukan'];
    $fasilitas_tujuan = trim($_POST['fasilitas_tujuan']);
    $poli_tujuan = trim($_POST['poli_tujuan']);
    $alasan_rujukan = trim($_POST['alasan_rujukan']);
    $diagnosa = trim($_POST['diagnosa']);
    $ICD_10 = trim($_POST['ICD_10']);

    $stmt = $conn->prepare("UPDATE surat_rujukan SET 
        tanggal_rujukan=?, fasilitas_tujuan=?, poli_tujuan=?, alasan_rujukan=?, diagnosa=?, ICD_10=? 
        WHERE id_rujukan=?");
    $stmt->bind_param("ssssssi", $tanggal_rujukan, $fasilitas_tujuan, $poli_tujuan, $alasan_rujukan, $diagnosa, $ICD_10, $id_rujukan);

    if ($stmt->execute()) {
        echo "<script>window.location='detail-hp.php?id_rm=$id_rm';</script>";
    } else {
        echo "<script>alert('Gagal update'); window.history.back();</script>";
    }

    $stmt->close();
}

if (isset($_POST['hapus_rujukan'])) {
    $id_rujukan = $_POST['id_rujukan'];
    $id_rm = $_POST['id_rm'];

    $delete = mysqli_query($conn, "DELETE FROM surat_rujukan WHERE id_rujukan = '$id_rujukan'");
    if ($delete) {
        echo "<script>window.location='detail-hp.php?id_rm=$id_rm';</script>";
    } else {
        echo "<script>alert('Gagal hapus data'); window.history.back();</script>";
    }
}
