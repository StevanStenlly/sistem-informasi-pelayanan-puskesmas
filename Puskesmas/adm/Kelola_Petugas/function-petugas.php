<?php
require '../../koneksi.php';

//Menambah data Petugas
if (isset($_POST['addnewpetugas'])) {
    $foto_petugas = $_FILES['foto_petugas']['name'];

    $file_extension = array('png', 'jpg', 'jpeg', 'gif');
    $extension = pathinfo($foto_petugas, PATHINFO_EXTENSION);
    $size_gambar = $_FILES['foto_petugas']['size'];


    $nama_petugas = $_POST['nama_petugas'];
    $jk_petugas = $_POST['jk_petugas'];
    $agama_petugas = $_POST['agama_petugas'];
    $nip_petugas = $_POST['nip_petugas'];
    $status_pernikahan_petugas = $_POST['status_pernikahan_petugas'];
    $alamat_petugas = $_POST['alamat_petugas'];
    $no_hp_petugas = $_POST['no_hp_petugas'];
    $password_petugas = $_POST['password_petugas'];
    $tempat_lahir_petugas = $_POST['tempat_lahir_petugas'];
    $tgl_lahir_petugas = $_POST['tgl_lahir_petugas'];
    $id_ruang = $_POST['id_ruang'];

    $query = mysqli_query($conn, "SELECT nip_petugas FROM petugas WHERE nip_petugas = '$nip_petugas'");

    if ($query->num_rows > 0) {
        echo "<script>alert('NIP sudah terdaftar');</script>";
    } else {
        if (!in_array($extension, $file_extension)) {
            echo "<script>alert('File Tidak Didukung!'); location = 'tambah-petugas.php'</script>";
        } else {


            move_uploaded_file($_FILES['foto_petugas']['tmp_name'], 'img/' . $foto_petugas);

            mysqli_query($conn, "INSERT into petugas (nip_petugas, foto_petugas, nama_petugas, jk_petugas, agama_petugas, status_pernikahan_petugas, alamat_petugas, no_hp_petugas, password_petugas, tgl_lahir_petugas, tempat_lahir_petugas, id_ruang) 
            VALUES ('$nip_petugas', '$foto_petugas', '$nama_petugas', '$jk_petugas', '$agama_petugas', '$status_pernikahan_petugas', '$alamat_petugas', '$no_hp_petugas', '$password_petugas', '$tgl_lahir_petugas', '$tempat_lahir_petugas', '$id_ruang')");

            echo "<script>alert('Data Berhasil di Tambahkan'); location = 'tabel-petugas.php'</script>";
        }
    }
}

//Update Data petugas
$ambilsemuapetugas = mysqli_query($conn, "SELECT * FROM petugas");

$data = mysqli_fetch_array($ambilsemuapetugas);

if (isset($_POST['updatepetugas'])) {
    $foto_petugas = $_FILES['foto_petugas']['name'];
    $path_gambar = "img/" . $data['foto_petugas'];

    $nama_petugas = $_POST['nama_petugas'];
    $jk_petugas = $_POST['jk_petugas'];
    $agama_petugas = $_POST['agama_petugas'];
    $nip_petugas = $_POST['nip_petugas'];
    $status_pernikahan_petugas = $_POST['status_pernikahan_petugas'];
    $alamat_petugas = $_POST['alamat_petugas'];
    $no_hp_petugas = $_POST['no_hp_petugas'];
    $password_petugas = $_POST['password_petugas'];
    $tempat_lahir_petugas = $_POST['tempat_lahir_petugas'];
    $tgl_lahir_petugas = $_POST['tgl_lahir_petugas'];
    $id_ruang = $_POST['id_ruang'];

    if (empty($foto_petugas)) {

        mysqli_query($conn, "UPDATE petugas SET nama_petugas='$nama_petugas', jk_petugas='$jk_petugas', agama_petugas='$agama_petugas', nip_petugas='$nip_petugas', 
        status_pernikahan_petugas='$status_pernikahan_petugas', alamat_petugas='$alamat_petugas', no_hp_petugas='$no_hp_petugas', 
        password_petugas='$password_petugas', tempat_lahir_petugas='$tempat_lahir_petugas', tgl_lahir_petugas='$tgl_lahir_petugas', id_ruang='$id_ruang' WHERE nip_petugas='$nip_petugas'");

        echo "<script>alert('Data Berhasil Diubah'); location = 'detail-petugas.php?nip_petugas=$nip_petugas' </script>";
    } else {

        move_uploaded_file($_FILES['foto_petugas']['tmp_name'], 'img/' . $foto_petugas);

        mysqli_query($conn, "UPDATE petugas SET foto_petugas='$foto_petugas', nama_petugas='$nama_petugas', jk_petugas='$jk_petugas', agama_petugas='$agama_petugas', 
        nip_petugas='$nip_petugas', status_pernikahan_petugas='$status_pernikahan_petugas', alamat_petugas='$alamat_petugas', 
        no_hp_petugas='$no_hp_petugas', password_petugas='$password_petugas', tempat_lahir_petugas='$tempat_lahir_petugas', tgl_lahir_petugas='$tgl_lahir_petugas', id_ruang='$id_ruang' WHERE nip_petugas='$nip_petugas'");

        echo "<script>alert('Data Berhasil  Diubah'); location = 'detail-petugas.php?nip_petugas=$nip_petugas'</script>";
    }
}

//Delete petugas
if (isset($_POST['hapuspetugas'])) {
    $nip_petugas = $_POST['nip_petugas'];

    $hapus = mysqli_query($conn, "DELETE FROM petugas where nip_petugas='$nip_petugas'");
    if ($hapus) {
        header('location:tabel-petugas.php');
    } else {
        echo 'Gagal';
        header('location:tabel-petugas.php');
    }
}
