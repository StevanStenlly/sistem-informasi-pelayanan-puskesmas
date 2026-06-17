<?php
require '../../koneksi.php';

//Menambah data pengumuman
if (isset($_POST['addnewpengumuman'])) {
    $foto_pengumuman = $_FILES['foto_pengumuman']['name'];

    $file_extension = array('png', 'jpg', 'jpeg', 'gif');
    $extension = pathinfo($foto_pengumuman, PATHINFO_EXTENSION);
    $size_gambar = $_FILES['foto_pengumuman']['size'];

    $judul_pengumuman = $_POST['judul_pengumuman'];
    $keterangan_pengumuman = $_POST['keterangan_pengumuman'];
    $tgl_pengumuman = $_POST['tgl_pengumuman'];

    if (!in_array($extension, $file_extension)) {
        echo "<script>alert('File Tidak Didukung!'); location = 'tabel-pengumuman.php'</script>";
    } else {


        move_uploaded_file($_FILES['foto_pengumuman']['tmp_name'], 'img/' . $foto_pengumuman);

        mysqli_query($conn, "INSERT into pengumuman (foto_pengumuman, judul_pengumuman, keterangan_pengumuman, tgl_pengumuman ) VALUES ('$foto_pengumuman', '$judul_pengumuman', '$keterangan_pengumuman', '$tgl_pengumuman')");

        echo "<script>alert('Data Berhasil di Tambahkan'); location = 'tabel-pengumuman.php'</script>";
    }
}

//Update Data pengumuman
$ambilsemuapengumuman = mysqli_query($conn, "SELECT * FROM pengumuman");

$data = mysqli_fetch_array($ambilsemuapengumuman);

if (isset($_POST['updatepengumuman'])) {
    $idpg = $_POST['idpg'];
    $foto_pengumuman = $_FILES['foto_pengumuman']['name'];
    $path_gambar = "img/" . $data['foto_pengumuman'];

    $judul_pengumuman = $_POST['judul_pengumuman'];
    $keterangan_pengumuman = $_POST['keterangan_pengumuman'];
    $tgl_pengumuman = $_POST['tgl_pengumuman'];

    if (empty($foto_pengumuman)) {

        mysqli_query($conn, "UPDATE pengumuman SET judul_pengumuman='$judul_pengumuman', keterangan_pengumuman='$keterangan_pengumuman', tgl_pengumuman='$tgl_pengumuman' WHERE id_pengumuman='$idpg'");

        echo "<script>alert('Data Berhasil Diubah'); location = 'tabel-pengumuman.php' </script>";
    } else {

        move_uploaded_file($_FILES['foto_pengumuman']['tmp_name'], 'img/' . $foto_pengumuman);

        mysqli_query($conn, "UPDATE pengumuman SET foto_pengumuman='$foto_pengumuman', judul_pengumuman='$judul_pengumuman', keterangan_pengumuman='$keterangan_pengumuman', tgl_pengumuman='$tgl_pengumuman' WHERE id_pengumuman='$idpg'");

        echo "<script>alert('Data Berhasil  Diubah'); location = 'tabel-pengumuman.php'</script>";
    }
}

//Delete pengumuman
if (isset($_POST['hapuspengumuman'])) {
    $idpg = $_POST['idpg'];

    $hapus = mysqli_query($conn, "DELETE FROM pengumuman where id_pengumuman='$idpg'");
    if ($hapus) {
        header('location:tabel-pengumuman.php');
    } else {
        echo 'Gagal';
        header('location:tabel-pengumuman.php');
    }
}
