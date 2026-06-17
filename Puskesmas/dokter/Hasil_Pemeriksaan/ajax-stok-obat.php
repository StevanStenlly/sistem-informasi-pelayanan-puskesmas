<?php
include "../../koneksi.php";

$obat = mysqli_query($conn, "SELECT * FROM obat");
$data = [];

while ($row = mysqli_fetch_assoc($obat)) {
    $data[] = [
        'kode_obat' => $row['kode_obat'],
        'nama_obat' => $row['nama_obat'],
        'dosis_obat' => $row['dosis_obat'],
        'satuan' => $row['satuan'],
        'stok_obat' => $row['stok_obat']
    ];
}

echo json_encode($data);
