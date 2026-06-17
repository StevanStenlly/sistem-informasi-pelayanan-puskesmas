<?php
// Sambungkan ke database
require '../../koneksi.php';

// Cek apakah form update dikirim
if (isset($_POST['updatepasien'])) {
    // Ambil dan sanitasi data dari form
    $idps = mysqli_real_escape_string($conn, $_POST['idps']);
    $jk_pasien = mysqli_real_escape_string($conn, $_POST['jk_pasien']);
    $agama_pasien = mysqli_real_escape_string($conn, $_POST['agama_pasien']);
    $status_pernikahan_pasien = mysqli_real_escape_string($conn, $_POST['status_pernikahan_pasien']);
    $alamat_pasien = mysqli_real_escape_string($conn, $_POST['alamat_pasien']);
    $no_hp_pasien = mysqli_real_escape_string($conn, $_POST['no_hp_pasien']);
    $tempat_lahir_pasien = mysqli_real_escape_string($conn, $_POST['tempat_lahir_pasien']);
    $tgl_lahir_pasien = mysqli_real_escape_string($conn, $_POST['tgl_lahir_pasien']);
    $riwayat_alergi_pasien = mysqli_real_escape_string($conn, $_POST['riwayat_alergi_pasien']);
    $pekerjaan_pasien = mysqli_real_escape_string($conn, $_POST['pekerjaan_pasien']);

    // Validasi password dan konfirmasi
    $password_baru = $_POST['password_pasien'] ?? '';
    $konfirmasi = $_POST['konfirmasi_password'] ?? '';

    if (!empty($password_baru)) {
        if ($password_baru !== $konfirmasi) {
            echo "<script>alert('Password dan konfirmasi tidak cocok'); location='users-profile.php'</script>";
            exit();
        }
        // Simpan langsung
        $plain_password = mysqli_real_escape_string($conn, $password_baru);
        $password_sql = ", password_pasien='$plain_password'";
    } else {
        $password_sql = "";
    }

    // Ambil nama file gambar lama dari database
    $query = mysqli_query($conn, "SELECT foto_pasien FROM pasien WHERE nik_pasien='$idps'");
    $data = mysqli_fetch_assoc($query);
    $old_foto = $data['foto_pasien'] ?? 'default.png';

    // Proses upload gambar jika ada
    $foto_pasien = $_FILES['foto_pasien']['name'];
    $tmp_name = $_FILES['foto_pasien']['tmp_name'];
    $upload_dir = '../../adm/Kelola_Pasien/img/';

    $allowed_types = ['jpg', 'jpeg', 'png'];
    $extension = strtolower(pathinfo($foto_pasien, PATHINFO_EXTENSION));

    if (!empty($foto_pasien)) {
        if (!in_array($extension, $allowed_types)) {
            echo "<script>alert('Format gambar tidak valid. Gunakan jpg/jpeg/png'); location='users-profile.php'</script>";
            exit();
        }

        $new_filename = uniqid('pasien_', true) . '.' . $extension;
        move_uploaded_file($tmp_name, $upload_dir . $new_filename);

        if ($old_foto !== 'default.png' && file_exists($upload_dir . $old_foto)) {
            unlink($upload_dir . $old_foto);
        }

        $foto_sql = ", foto_pasien='$new_filename'";
    } else {
        $foto_sql = "";
    }

    // Lakukan update data pasien ke database
    $update = mysqli_query($conn, "UPDATE pasien SET
      jk_pasien='$jk_pasien',
      agama_pasien='$agama_pasien',
      status_pernikahan_pasien='$status_pernikahan_pasien',
      alamat_pasien='$alamat_pasien',
      no_hp_pasien='$no_hp_pasien',
      tempat_lahir_pasien='$tempat_lahir_pasien',
      tgl_lahir_pasien='$tgl_lahir_pasien',
      riwayat_alergi_pasien='$riwayat_alergi_pasien',
      pekerjaan_pasien='$pekerjaan_pasien'
      $foto_sql
      $password_sql
      WHERE nik_pasien='$idps'");

    if ($update) {
        echo "<script>alert('Data berhasil diperbarui'); location='users-profile.php'</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data'); location='users-profile.php'</script>";
    }
}
