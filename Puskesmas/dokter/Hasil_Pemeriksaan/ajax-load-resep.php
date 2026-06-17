<?php
include "../../koneksi.php";

$id_rm = $_POST['id_rm'];

$q = mysqli_query($conn, "SELECT r.*, o.nama_obat, o.dosis_obat, o.satuan 
    FROM resep_obat r 
    LEFT JOIN obat o ON r.kode_obat = o.kode_obat 
    WHERE r.id_rm = '$id_rm' ORDER BY r.id_resep DESC");

$no = 1;
?>

<table class="table table-bordered table-striped">
    <thead class="table-secondary">
        <tr>
            <th>No</th>
            <th>Nama Obat</th>
            <th>Dosis</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($res = mysqli_fetch_assoc($q)): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $res['nama_obat']; ?> <?= $res['dosis_obat']; ?> <?= $res['satuan']; ?></td>
                <td><?= $res['dosis']; ?></td>
                <td><?= $res['jumlah']; ?></td>
                <td class="text-center">
                    <button class="btn btn-warning btn-sm btn-edit-resep"
                        data-id="<?= $res['id_resep']; ?>"
                        data-kode="<?= $res['kode_obat']; ?>"
                        data-nama="<?= $res['nama_obat']; ?>"
                        data-dosis="<?= $res['dosis']; ?>"
                        data-jumlah="<?= $res['jumlah']; ?>">
                        <i class="bi bi-pencil-square"></i>
                    </button>

                    <button class="btn btn-danger btn-sm btn-hapus-resep"
                        data-id="<?= $res['id_resep']; ?>"
                        data-kode="<?= $res['kode_obat']; ?>"
                        data-jumlah="<?= $res['jumlah']; ?>">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </td>

            </tr>
        <?php endwhile; ?>
    </tbody>
</table>