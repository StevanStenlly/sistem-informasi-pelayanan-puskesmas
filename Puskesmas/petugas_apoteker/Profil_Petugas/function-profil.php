<?php
require '../../koneksi.php';

//Update Data petugas
$ambilsemuapetugas = mysqli_query($conn, "SELECT * FROM petugas");

$data = mysqli_fetch_array($ambilsemuapetugas);

if (isset($_POST['updatepetugas'])) {
    $idp = $_POST['idp'];
    $foto_petugas = $_FILES['foto_petugas']['name'];
    $path_gambar = "../../adm/Kelola_Petugas/img/" . $data['foto_petugas'];

    $nama_petugas = $_POST['nama_petugas'];
    $jk_petugas = $_POST['jk_petugas'];
    $agama_petugas = $_POST['agama_petugas'];
    $nip_petugas = $_POST['nip_petugas'];
    $status_pernikahan_petugas = $_POST['status_pernikahan_petugas'];
    $status_petugas = $_POST['status_petugas'];
    $alamat_petugas = $_POST['alamat_petugas'];
    $no_hp_petugas = $_POST['no_hp_petugas'];
    $password_petugas = $_POST['password_petugas'];
    $ttl_petugas = $_POST['ttl_petugas'];

    if (empty($foto_petugas)) {

        mysqli_query($conn, "UPDATE petugas SET nama_petugas='$nama_petugas', jk_petugas='$jk_petugas', agama_petugas='$agama_petugas', nip_petugas='$nip_petugas', status_pernikahan_petugas='$status_pernikahan_petugas', status_petugas='$status_petugas', alamat_petugas='$alamat_petugas', no_hp_petugas='$no_hp_petugas', password_petugas='$password_petugas', ttl_petugas='$ttl_petugas' WHERE nip_petugas='$idp'");

        echo "<script>alert('Data Berhasil Diubah'); location = 'tabel-petugas.php' </script>";
    } else {

        move_uploaded_file($_FILES['gambar']['tmp_name'], '../../adm/Kelola_Petugas/img/' . $gambar);

        mysqli_query($conn, "UPDATE petugas SET foto_petugas='$foto_petugas', nama_petugas='$nama_petugas', jk_petugas='$jk_petugas', agama_petugas='$agama_petugas', nip_petugas='$nip_petugas', status_pernikahan_petugas='$status_pernikahan_petugas', status_petugas='$status_petugas', alamat_petugas='$alamat_petugas', no_hp_petugas='$no_hp_petugas', password_petugas='$password_petugas', ttl_petugas='$ttl_petugas' WHERE nip_petugas='$idp'");

        echo "<script>alert('Data Berhasil  Diubah'); location = 'tabel-petugas.php'</script>";
    }
}
