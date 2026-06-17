<?php
//pemanggilan koneksi
include "../../koneksi.php";

//deskripsi variabel 

$id_rm = $_GET['id_rm'];
$status = 'Tidak Dikonfirmasi';

$query = "UPDATE rekam_medis SET status='$status' WHERE id_rm='$id_rm'";

$hasil = mysqli_query($conn, $query);
if ($hasil) {
    echo "<script>  window.location='tabel-screening.php';</script>";
} else {
    echo "<script> alert('Tidak Dapat Mengubah Status'); history.back();</script>";
}
