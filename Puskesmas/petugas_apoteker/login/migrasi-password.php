<?php
include "../../koneksi.php";

// Ambil semua petugas
$query = mysqli_query($conn, "SELECT nip_petugas, password_petugas FROM petugas");

while ($row = mysqli_fetch_assoc($query)) {
    $nip = $row['nip_petugas'];
    $plaintext = $row['password_petugas'];

    // Cek apakah password sudah ter-hash (panjang hash umumnya > 50 karakter, diawali $2y$)
    if (strlen($plaintext) < 50 || !preg_match('/^\$2y\$/', $plaintext)) {
        $hashed = password_hash($plaintext, PASSWORD_DEFAULT);

        // Update password di database
        $update = mysqli_prepare($conn, "UPDATE petugas SET password_petugas = ? WHERE nip_petugas = ?");
        mysqli_stmt_bind_param($update, "ss", $hashed, $nip);
        mysqli_stmt_execute($update);

        echo "Password untuk NIP $nip telah di-hash.<br>";
    } else {
        echo "NIP $nip sudah menggunakan hash. Dilewati.<br>";
    }
}
echo "<br>Selesai! Jangan lupa hapus file ini.";
