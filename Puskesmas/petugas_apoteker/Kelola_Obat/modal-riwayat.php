<?php

?>
<div class="modal fade" id="riwayat<?= $ido; ?>" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Riwayat Obat Masuk - <?= $nama_obat; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-bordered">
                    <thead class="table-secondary">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Masuk</th>
                            <th>Jumlah</th>
                            <th>Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $riwayat = mysqli_query($conn, "
                            SELECT om.*, p.nama_petugas 
                            FROM obat_masuk om 
                            LEFT JOIN petugas p ON om.nip_petugas = p.nip_petugas 
                            WHERE kode_obat = '$ido' 
                            ORDER BY tanggal_masuk DESC
                        ");
                        $no = 1;
                        while ($r = mysqli_fetch_assoc($riwayat)) {
                            echo "<tr>
                                <td>{$no}</td>
                                <td>" . date('Y-m-d', strtotime($r['tanggal_masuk'])) . "</td>
                                <td>" . ($r['jumlah_masuk'] > 100 ? "<span class='badge bg-success'>{$r['jumlah_masuk']}</span>" : $r['jumlah_masuk']) . "</td>
                                <td>" . (isset($r['nama_petugas']) ? $r['nama_petugas'] : '-') . "</td>
                            </tr>";
                            $no++;
                        }
                        if ($no === 1) {
                            echo "<tr><td colspan='4' class='text-center'>Belum ada data masuk</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>