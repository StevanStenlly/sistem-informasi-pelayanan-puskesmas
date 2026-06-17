<?php

//Membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "db_puskesmas");

//cek koneksi
if (mysqli_connect_error()) {
    echo "koneksi database gagal ! : " . mysqli_connect_error();
}
