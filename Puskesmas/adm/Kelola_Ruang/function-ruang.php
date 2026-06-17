<?php
require '../../koneksi.php';

//Menambah data obat
if (isset($_POST['addnewruang'])) {
    $nama_ruang = $_POST['nama_ruang'];
    $tipe_ruang = $_POST['tipe_ruang'];

    $query = mysqli_query($conn, "INSERT INTO ruang (nama_ruang, tipe_ruang) VALUES ('$nama_ruang', '$tipe_ruang')");

    if ($query) {
        echo "<script> window.location='tabel-ruang.php';</script>";
    } else {
        echo "<script> alert('Proses tambah Ruang gagal'); history.back();</script>";
    }
}

//Update Data ruang
$ambilsemuaruang = mysqli_query($conn, "SELECT * FROM ruang");

$data = mysqli_fetch_array($ambilsemuaruang);

if (isset($_POST['updateruang'])) {
    $idr = $_POST['idr'];

    $nama_ruang = $_POST['nama_ruang'];

    $update = mysqli_query($conn, "UPDATE ruang SET nama_ruang ='$nama_ruang' WHERE id_ruang='$idr'");
    if ($update) {
        header('location:tabel-ruang.php');
    } else {
        echo 'Gagal';
        header('location:tabel-ruang.php');
    }
}

//Delete ruang
if (isset($_POST['hapusruang'])) {
    $idr = $_POST['idr'];

    $hapus = mysqli_query($conn, "DELETE FROM ruang where id_ruang='$idr'");
    if ($hapus) {
        header('location:tabel-ruang.php');
    } else {
        echo 'Gagal';
        header('location:tabel-ruang.php');
    }
}
