<?php
include "../../koneksi.php";
$id_rm = $_GET['id_rm'];
?>
<table class="table table-bordered table-striped">
    <thead class="table-secondary">
        <tr>
            <th>No</th>
            <th>Nama Obat</th>
            <th>Dosis</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $riwayat = mysqli_query($conn, "SELECT r.*, o.nama_obat, o.dosis_obat, o.satuan FROM resep_obat r 
    LEFT JOIN obat o ON r.kode_obat = o.kode_obat WHERE r.id_rm = '$id_rm' ORDER BY id_resep DESC");
        $no = 1;
        while ($res = mysqli_fetch_array($riwayat)) {
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $res['nama_obat']; ?> <?= $res['dosis_obat']; ?> <?= $res['satuan']; ?></td>
                <td><?= $res['dosis']; ?></td>
                <td><?= $res['jumlah']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>