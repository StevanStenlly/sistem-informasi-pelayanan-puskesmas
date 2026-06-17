<?php

if (isset($_POST['addnew'])) {
    // Cek apakah hari ini Minggu
    if (date('w') == 0) { // 0 = Sunday
        echo "<script>alert('Pendaftaran pelayanan tidak tersedia pada hari Minggu'); window.location='pelayanan_kesehatan.php';</script>";
        exit;
    }

    $nik_pasien = $_POST['nik_pasien'];
    $sakit = mysqli_real_escape_string($conn, $_POST['sakit']);

    $query = mysqli_query(
        $conn,
        "INSERT INTO rekam_medis (nik_pasien, sakit, tgl_pemeriksaan)
         VALUES ('$nik_pasien', '$sakit', CURDATE())"
    );

    if ($query) {
        echo "<script> window.location='pelayanan_kesehatan.php';</script>";
    } else {
        echo "<script> alert('Proses tambah pelayanan gagal'); history.back();</script>";
    }
}
