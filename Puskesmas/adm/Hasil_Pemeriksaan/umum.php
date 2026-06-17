<div class="tab-pane fade show active profile-1" id="profile-1">
    <h5 class="card-title">Ruang Pemeriksaan Umum</h5>

    <div class="card mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table datatable table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Pasien</th>
                            <th>NIK Pasien</th>
                            <th>No.Kartu Pasien</th>
                            <th>NO.Rekam Medis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        $ambilsemuahasil = mysqli_query($conn, "SELECT * FROM hasil_pemeriksaan a left join screening b on a.id_screening=b.id_screening
                            left join ruang c on a.id_ruang=c.id_ruang left join pasien d on a.nik_pasien=d.nik_pasien left join dokter e on a.nip_dokter=e.nip_dokter WHERE a.id_ruang = '1' ORDER BY id_hasil DESC");
                        $i = 1;
                        while ($data = mysqli_fetch_array($ambilsemuahasil)) {
                            $id_hasil = $data['id_hasil'];
                            $nip_dokter = $data['nip_dokter'];
                            $id_screening = $data['id_screening'];
                            $nik_pasien  = $data['nik_pasien'];
                            $no_kartu_pasien  = $data['no_kartu_pasien'];
                            $tgl_pemeriksaan = $data['tgl_pemeriksaan'];
                            $sakit = $data['sakit'];
                            $nama_pasien = $data['nama_pasien'];
                            $ttl_pasien = $data['ttl_pasien'];
                            $jk_pasien = $data['jk_pasien'];
                            $id_ruang = $data['id_ruang'];
                            $nama_ruang = $data['nama_ruang'];
                            $rm = $data['rm'];
                        ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $tgl_pemeriksaan; ?></td>
                                <td><?= $nama_pasien; ?></td>
                                <td><?= $nik_pasien; ?></td>
                                <td><?= $no_kartu_pasien; ?></td>
                                <td><?= $rm; ?></td>
                                <td>

                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapushasil<?= $id_hasil; ?>"><i class=" bi bi-trash-fill"></i></button>
                                        <a type="button" class="btn btn-primary btn-sm" href="detail-hp.php?id_hasil=<?php echo $data["id_hasil"]; ?>"><i class=" bi bi-eye-fill"></i></a>
                                        <a type="button" class="btn btn-success btn-sm" href="../../cetak/cetak-hp.php?id_hasil=<?php echo $data["id_hasil"]; ?>"><i class=" bi bi-printer-fill"></i></a>

                                    </div>

                                </td>
                            </tr>

                            <?php
                            include 'update-hp.php';
                            include 'delete-hp.php';
                            ?>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>

        </div>
    </div>

</div>