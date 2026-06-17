                <!-- Update Modal -->
                <div class="modal fade" id="update<?= $idpg; ?>">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Update Data</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <!-- Modal body -->
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <label>Tanggal</label>
                                    <br>
                                    <input type="date" name="tgl_pengumuman" value="<?= $tgl_pengumuman; ?>">
                                    <br>
                                    <br>

                                    <label>Gambar Pengumuman</label>
                                    <input type="file" name="foto_pengumuman" value="<?= $foto_pengumuman; ?>" class="form-control-file">
                                    <br>
                                    <small id="fileHelpId" class="form-text text-muted">Upload file image (jpg,jpeg,png)</small>
                                    <br>
                                    <img src="img/<?php echo $foto_pengumuman; ?>" alt="<?php echo $foto_pengumuman; ?>" height="100" width="100">
                                    <br>

                                    <label>Judul</label>
                                    <input type="text" name="judul_pengumuman" value="<?= $judul_pengumuman; ?>" placeholder="Judul" class="form-control">
                                    <br>

                                    <label>Keterangan</label>
                                    <textarea type="text" name="keterangan_pengumuman" value="<?= $keterangan_pengumuman; ?>" rows="4" class="form-control"><?php echo $keterangan_pengumuman ?></textarea>
                                    <br>


                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <input type="hidden" name="idpg" value="<?= $idpg; ?>">
                                    <button type="submit" class="btn btn-primary" name="updatepengumuman">Perbarui</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>