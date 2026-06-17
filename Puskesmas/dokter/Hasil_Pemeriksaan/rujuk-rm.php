<h5 class="card-title mt-4">Riwayat Resep Obat</h5>
<div class="table-responsive">
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
                                                    LEFT JOIN obat o ON r.kode_obat = o.kode_obat 
                                                    WHERE r.id_rm = '$id_rm' ORDER BY id_resep DESC");
            $no = 1;
            while ($res = mysqli_fetch_array($riwayat)) {
                $dosis_obat = $res['dosis_obat'];
                $satuan = $res['satuan'];
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $res['nama_obat']; ?> <?= $dosis_obat; ?> <?= $satuan; ?></td>
                    <td><?= $res['dosis']; ?></td>
                    <td><?= $res['jumlah']; ?></td>
                </tr>




            <?php } ?>
        </tbody>
    </table>
</div>

<div class="text-center">
    <a href="cetak-pdf.php?id_rm=<?= $id_rm; ?>" class="btn btn-outline-primary btn-sm" target="_blank">
        <i class="bi bi-printer-fill"></i> Cetak PDF
    </a>

</div>

<h5 class="card-title mt-4">Riwayat Surat Rujukan</h5>

<table class="table table-bordered table-striped">
    <thead class="table-primary">
        <tr class="text-center">
            <th>No</th>
            <th>Nomor Rujukan</th>
            <th>Tanggal</th>
            <th>Fasilitas Tujuan</th>
            <th>Poli Tujuan</th>
            <th>Dokter/Admin</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $rujukan_q = mysqli_query($conn, "SELECT * FROM surat_rujukan WHERE id_rm = '$id_rm' ORDER BY tanggal_rujukan DESC");
        $no = 1;
        while ($rj = mysqli_fetch_assoc($rujukan_q)) {
        ?>
            <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td><?= $rj['no_rujukan']; ?></td>
                <td class="text-center"><?= $rj['tanggal_rujukan']; ?></td>
                <td><?= $rj['fasilitas_tujuan']; ?></td>
                <td><?= $rj['poli_tujuan']; ?></td>
                <td><?= $rj['nama_pengirim']; ?></td>
                <td class="text-center">
                    <a href="cetak-rujukan.php?id=<?= $rj['id_rujukan']; ?>" class="btn btn-sm btn-outline-primary" target="_blank">
                        <i class="bi bi-printer"></i> Cetak
                    </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>