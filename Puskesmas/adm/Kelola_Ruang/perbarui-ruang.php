                <!-- Update Modal -->
                <div class="modal fade" id="update<?= $idr; ?>">
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

                                    <label>Nama</label>
                                    <input type="text" name="nama_ruang" value="<?= $nama_ruang; ?>" placeholder="Nama" class="form-control">
                                    <br>

                                    <div class="form-group">
                                        <label for="tipe_ruang">Tipe Ruang</label>
                                        <select class="form-control form-select" name="tipe_ruang" required>
                                            <option value="pelayanan" <?= $data['tipe_ruang'] == 'pelayanan' ? 'selected' : '' ?>>Pelayanan</option>
                                            <option value="internal" <?= $data['tipe_ruang'] == 'internal' ? 'selected' : '' ?>>Internal</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <input type="hidden" name="idr" value="<?= $idr; ?>">
                                    <button type="submit" class="btn btn-primary" name="updateruang">Perbarui</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>