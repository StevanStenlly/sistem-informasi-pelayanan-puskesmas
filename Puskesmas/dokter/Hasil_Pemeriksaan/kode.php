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



                                                        <!-- Modal Surat Rujukan -->
                                                        <div class="modal fade" id="modalRujukan" tabindex="-1">
                                                            <div class="modal-dialog modal-lg">
                                                                <form action="function-hp.php" method="POST">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Buat Surat Rujukan</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                            <input type="hidden" name="id_rm" value="<?= $id_rm; ?>">
                                                                            <input type="hidden" name="nip_pengirim" value="<?= $_SESSION['dokter_nip'] ?? $_SESSION['id_admin']; ?>">
                                                                            <input type="hidden" name="nama_pengirim" value="<?= $nama_dokter ?? 'Admin'; ?>">

                                                                            <div class="row mb-3">
                                                                                <label class="col-sm-3 col-form-label">Tanggal Rujukan</label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="date" class="form-control" name="tanggal_rujukan" required value="<?= date('Y-m-d'); ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mb-3">
                                                                                <label class="col-sm-3 col-form-label">Fasilitas Tujuan</label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="text" class="form-control" name="fasilitas_tujuan" placeholder="Contoh: RSUD Kabupaten X" required>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mb-3">
                                                                                <label class="col-sm-3 col-form-label">Poli / Spesialis Tujuan</label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="text" class="form-control" name="poli_tujuan" placeholder="Contoh: Poli Saraf / Bedah Umum">
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mb-3">
                                                                                <label class="col-sm-3 col-form-label">Alasan Rujukan</label>
                                                                                <div class="col-sm-9">
                                                                                    <textarea name="alasan_rujukan" class="form-control" rows="3" required></textarea>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mb-3">
                                                                                <label class="col-sm-3 col-form-label">Diagnosa</label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="text" name="diagnosa" class="form-control" value="<?= $nama_penyakit; ?>" required>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mb-3">
                                                                                <label class="col-sm-3 col-form-label">ICD 10</label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="text" name="ICD_10" class="form-control" value="<?= $ICD_10; ?>">
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" name="simpan_rujukan" class="btn btn-success">Simpan</button>
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>


                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="text-center">
                                            <a href="cetak-pdf.php?id_rm=<?= $id_rm; ?>" class="btn btn-outline-primary btn-sm" target="_blank">
                                                <i class="bi bi-printer-fill"></i> Cetak PDF
                                            </a>

                                            <a href="#" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalRujukan">
                                                <i class="bi bi-file-earmark-arrow-up"></i> Buat Surat Rujukan
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
                                                    <th>Dokter</th>
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

                                                            <!-- Tombol Edit -->
                                                            <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalEditRujukan<?= $rj['id_rujukan']; ?>">
                                                                <i class="bi bi-pencil"></i> Update
                                                            </button>

                                                            <!-- Tombol Hapus -->
                                                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalHapusRujukan<?= $rj['id_rujukan']; ?>">
                                                                <i class="bi bi-trash"></i> Hapus
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <div class="modal fade" id="modalEditRujukan<?= $rj['id_rujukan']; ?>" tabindex="-1">
                                                        <div class="modal-dialog modal-lg">
                                                            <form method="POST" action="function-hp.php">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Edit Surat Rujukan</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="update_rujukan" value="1">
                                                                        <input type="hidden" name="id_rujukan" value="<?= $rj['id_rujukan']; ?>">
                                                                        <input type="hidden" name="id_rm" value="<?= $id_rm; ?>">

                                                                        <div class="row mb-3">
                                                                            <label class="col-sm-3 col-form-label">Tanggal Rujukan</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="date" name="tanggal_rujukan" class="form-control" value="<?= $rj['tanggal_rujukan']; ?>" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mb-3">
                                                                            <label class="col-sm-3 col-form-label">Fasilitas Tujuan</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" name="fasilitas_tujuan" class="form-control" value="<?= $rj['fasilitas_tujuan']; ?>" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mb-3">
                                                                            <label class="col-sm-3 col-form-label">Poli Tujuan</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" name="poli_tujuan" class="form-control" value="<?= $rj['poli_tujuan']; ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mb-3">
                                                                            <label class="col-sm-3 col-form-label">Alasan Rujukan</label>
                                                                            <div class="col-sm-9">
                                                                                <textarea name="alasan_rujukan" class="form-control" rows="3" required><?= $rj['alasan_rujukan']; ?></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mb-3">
                                                                            <label class="col-sm-3 col-form-label">Diagnosa</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" name="diagnosa" class="form-control" value="<?= $rj['diagnosa']; ?>" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mb-3">
                                                                            <label class="col-sm-3 col-form-label">ICD 10</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" name="ICD_10" class="form-control" value="<?= $rj['ICD_10']; ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-success" name="update_rujukan">Simpan</button>
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                    <div class="modal fade" id="modalHapusRujukan<?= $rj['id_rujukan']; ?>" tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <form method="POST" action="function-hp.php">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Hapus Surat Rujukan</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="hapus_rujukan" value="1">
                                                                        <input type="hidden" name="id_rujukan" value="<?= $rj['id_rujukan']; ?>">
                                                                        <input type="hidden" name="id_rm" value="<?= $id_rm; ?>">
                                                                        <p>Yakin ingin menghapus surat rujukan <strong><?= $rj['no_rujukan']; ?></strong>?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                <?php } ?>
                                            </tbody>
                                        </table>