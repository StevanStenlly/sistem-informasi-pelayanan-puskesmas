<?php
require '../../koneksi.php';

//Menambah data rm
if (isset($_POST['addnewrm'])) {
    $foto_rm = $_FILES['foto_dokter']['name'];

    $file_extension = array('png', 'jpg', 'jpeg', 'gif');
    $extension = pathinfo($foto_dokter, PATHINFO_EXTENSION);
    $size_gambar = $_FILES['foto_dokter']['size'];


    $nama_dokter = $_POST['nama_dokter'];
    $jk_dokter = $_POST['jk_dokter'];
    $agama_dokter = $_POST['agama_dokter'];
    $nip_dokter = $_POST['nip_dokter'];
    $status_pernikahan_dokter = $_POST['status_pernikahan_dokter'];
    $status_dokter = $_POST['status_dokter'];
    $alamat_dokter = $_POST['alamat_dokter'];
    $no_hp_dokter = $_POST['no_hp_dokter'];
    $password_dokter = $_POST['password_dokter'];
    $ttl_dokter = $_POST['ttl_dokter'];

    $query = mysqli_query($conn, "SELECT nip_dokter FROM dokter WHERE nip_dokter = '$nip_dokter'");

    if ($query->num_rows > 0) {
        echo "<script>alert('NIP sudah terdaftar');</script>";
    } else {
        if (!in_array($extension, $file_extension)) {
            echo "<script>alert('File Tidak Didukung!'); location = 'tabel-dokter.php'</script>";
        } else {


            move_uploaded_file($_FILES['foto_dokter']['tmp_name'], 'img/' . $foto_dokter);

            mysqli_query($conn, "INSERT into dokter (nip_dokter, foto_dokter, nama_dokter, jk_dokter, agama_dokter, status_pernikahan_dokter, status_dokter, alamat_dokter, no_hp_dokter, password_dokter, ttl_dokter) VALUES ('$nip_dokter', '$foto_dokter', '$nama_dokter', '$jk_dokter', '$agama_dokter', '$status_pernikahan_dokter', '$status_dokter', '$alamat_dokter', '$no_hp_dokter', '$password_dokter', '$ttl_dokter')");

            echo "<script>alert('Data Berhasil di Tambahkan'); location = 'tabel-dokter.php'</script>";
        }
    }
}

//Update Data Dokter
$ambilsemuadokter = mysqli_query($conn, "SELECT * FROM dokter");

$data = mysqli_fetch_array($ambilsemuadokter);

if (isset($_POST['updatedokter'])) {
    $idd = $_POST['idd'];
    $foto_dokter = $_FILES['foto_dokter']['name'];
    $path_gambar = "img/" . $data['foto_dokter'];

    $nama_dokter = $_POST['nama_dokter'];
    $jk_dokter = $_POST['jk_dokter'];
    $agama_dokter = $_POST['agama_dokter'];
    $nip_dokter = $_POST['nip_dokter'];
    $status_pernikahan_dokter = $_POST['status_pernikahan_dokter'];
    $status_dokter = $_POST['status_dokter'];
    $alamat_dokter = $_POST['alamat_dokter'];
    $no_hp_dokter = $_POST['no_hp_dokter'];
    $password_dokter = $_POST['password_dokter'];
    $ttl_dokter = $_POST['ttl_dokter'];

    if (empty($foto_dokter)) {

        mysqli_query($conn, "UPDATE dokter SET nama_dokter='$nama_dokter', jk_dokter='$jk_dokter', agama_dokter='$agama_dokter', nip_dokter='$nip_dokter', status_pernikahan_dokter='$status_pernikahan_dokter', status_dokter='$status_dokter', alamat_dokter='$alamat_dokter', no_hp_dokter='$no_hp_dokter', password_dokter='$password_dokter', ttl_dokter='$ttl_dokter' WHERE nip_dokter='$idd'");

        echo "<script>alert('Data Berhasil Diubah'); location = 'tabel-dokter.php' </script>";
    } else {

        move_uploaded_file($_FILES['foto_dokter']['tmp_name'], 'img/' . $foto_dokter);

        mysqli_query($conn, "UPDATE dokter SET foto_dokter='$foto_dokter', nama_dokter='$nama_dokter', jk_dokter='$jk_dokter', agama_dokter='$agama_dokter', nip_dokter='$nip_dokter', status_pernikahan_dokter='$status_pernikahan_dokter', status_dokter='$status_dokter', alamat_dokter='$alamat_dokter', no_hp_dokter='$no_hp_dokter', password_dokter='$password_dokter', ttl_dokter='$ttl_dokter' WHERE nip_dokter='$idd'");

        echo "<script>alert('Data Berhasil  Diubah'); location = 'tabel-dokter.php'</script>";
    }
}

//Delete Dokter
if (isset($_POST['hapusdokter'])) {
    $idd = $_POST['idd'];

    $hapus = mysqli_query($conn, "DELETE FROM dokter where nip_dokter='$idd'");
    if ($hapus) {
        echo "<script> alert('Proses Hapus Data Dokter Berhasil'); window.location='tabel-dokter.php';</script>";
    } else {
        echo "<script> alert('Proses Hapus Data Admin Gagal')</script>";
        header('location:tabel-dokter.php');
    }
}
