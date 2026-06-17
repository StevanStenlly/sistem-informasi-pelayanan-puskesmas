<?php
include "../../koneksi.php";

if (isset($_POST['nik'])) {
    $nik = mysqli_real_escape_string($conn, $_POST['nik']);
    $cek = mysqli_query($conn, "SELECT * FROM pasien WHERE nik_pasien = '$nik'");
    echo mysqli_num_rows($cek) > 0 ? "exists" : "available";
}
