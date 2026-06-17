<?php

//Update Data Dokter
$ambilsemuadokter = mysqli_query($conn, "SELECT * FROM dokter");

$data = mysqli_fetch_array($ambilsemuadokter);

if (isset($_POST['updatedokter'])) {
    $idd = $_POST['idd'];
    $foto_dokter = $_FILES['foto_dokter']['name'];
    $path_gambar = "../../adm/Kelola_Dokter/img/" . $data['foto_dokter'];

    $nama_dokter = $_POST['nama_dokter'];
    $jk_dokter = $_POST['jk_dokter'];
    $agama_dokter = $_POST['agama_dokter'];
    $nip_dokter = $_POST['nip_dokter'];
    $status_pernikahan_dokter = $_POST['status_pernikahan_dokter'];
    $status_dokter = $_POST['status_dokter'];
    $alamat_dokter = $_POST['alamat_dokter'];
    $no_hp_dokter = $_POST['no_hp_dokter'];
    $password_dokter = $_POST['password_dokter'];
    $tempat_lahir_dokter = $_POST['tempat_lahir_dokter'];
    $tgl_lahir_dokter = $_POST['tgl_lahir_dokter'];

    if (empty($foto_dokter)) {

        mysqli_query($conn, "UPDATE dokter SET nama_dokter='$nama_dokter', jk_dokter='$jk_dokter', agama_dokter='$agama_dokter', nip_dokter='$nip_dokter', 
        status_pernikahan_dokter='$status_pernikahan_dokter', status_dokter='$status_dokter', alamat_dokter='$alamat_dokter', no_hp_dokter='$no_hp_dokter', 
        password_dokter='$password_dokter', tempat_lahir_dokter='$tempat_lahir_dokter', tgl_lahir_dokter='$tgl_lahir_dokter' WHERE nip_dokter='$idd'");

        echo "<script>alert('Data Berhasil Diubah'); location = 'users-profile.php' </script>";
    } else {

        move_uploaded_file($_FILES['foto_dokter']['tmp_name'], '../../adm/Kelola_Dokter/img/' . $foto_dokter);

        mysqli_query($conn, "UPDATE dokter SET foto_dokter='$foto_dokter', nama_dokter='$nama_dokter', jk_dokter='$jk_dokter', agama_dokter='$agama_dokter', 
        nip_dokter='$nip_dokter', status_pernikahan_dokter='$status_pernikahan_dokter', status_dokter='$status_dokter', alamat_dokter='$alamat_dokter', 
        no_hp_dokter='$no_hp_dokter', password_dokter='$password_dokter', tempat_lahir_dokter='$tempat_lahir_dokter', tgl_lahir_dokter='$tgl_lahir_dokter' WHERE nip_dokter='$idd'");

        echo "<script>alert('Data Berhasil  Diubah'); location = 'users-profile.php'</script>";
    }
}
