<?php
session_name("SCREENING_SESSION");
session_start();
include "../../koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

$search = $_POST['search'] ?? '';

$data = [];

if (!empty($search)) {
    $search = mysqli_real_escape_string($conn, $search);
    $query = "SELECT nik_pasien FROM pasien WHERE nik_pasien LIKE '%$search%' LIMIT 10";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = [
            "id" => $row['nik_pasien'],
            "text" => $row['nik_pasien']
        ];
    }
}

echo json_encode($data);
