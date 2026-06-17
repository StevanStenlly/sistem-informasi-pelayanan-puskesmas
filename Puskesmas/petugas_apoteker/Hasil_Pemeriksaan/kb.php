<div class="tab-pane fade profile-2" id="profile-2">
    <h5 class="card-title">Ruang Pemeriksaan KIA-KB</h5>

    <div class="card mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table datatable table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pemeriksaan</th>
                            <th>Nama Pasien</th>
                            <th>NIK Pasien</th>
                            <th>Nama Penyakit</th>
                            <th>Resep Obat</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        $ambilsemuahasil = mysqli_query($conn, "SELECT * FROM rekam_medis a left join ruang c on a.id_ruang=c.id_ruang 
                        left join pasien d on a.nik_pasien=d.nik_pasien left join dokter e on a.nip_dokter=e.nip_dokter WHERE a.id_ruang = '2'");
                        $i = 1;
                        while ($data = mysqli_fetch_array($ambilsemuahasil)) {
                            $id_rm = $data['id_rm'];
                            $nip_dokter = $data['nip_dokter'];
                            $id_screening = $data['id_screening'];
                            $nik_pasien  = $data['nik_pasien'];
                            $tgl_pemeriksaan = $data['tgl_pemeriksaan'];
                            $sakit = $data['sakit'];
                            $nama_pasien = $data['nama_pasien'];
                            $ttl_pasien = $data['ttl_pasien'];
                            $jk_pasien = $data['jk_pasien'];
                            $id_ruang = $data['id_ruang'];
                            $nama_penyakit = $data['nama_penyakit'];
                            $resep_obat = $data['resep_obat'];
                        ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $tgl_pemeriksaan; ?></td>
                                <td><?= $nama_pasien; ?></td>
                                <td><?= $nik_pasien; ?></td>
                                <td><?= $nama_penyakit; ?></td>
                                <td><?= $resep_obat; ?></td>

                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>

        </div>
    </div>

</div>