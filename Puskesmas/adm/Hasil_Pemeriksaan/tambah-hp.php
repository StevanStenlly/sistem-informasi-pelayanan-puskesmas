<!-- The Modal -->
<div class="modal fade" id="ExtralargeModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal body -->
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <label>Foto</label>
                    <br>
                    <input type="file" name="foto_dokter" class="form-control-file" required>
                    <br>
                    <small id="fileHelpId" class="form-text text-muted">Upload file image (jpg,jpeg,png)</small>
                    <br>
                    <br>
                    <label>NIP</label>
                    <input type="text" name="nip_dokter" placeholder="NIP" class="form-control" maxlength="16" required>
                    <br>
                    <label>Nama</label>
                    <input type="text" name="nama_dokter" placeholder="Nama" class="form-control" required>
                    <br>
                    <label>Jenis Kelamin</label>
                    <div class="mb-3 row">
                        <div class="col-sm-10">
                            <select class="form-control" name="jk_dokter" required>
                                <option value="">- Pilih -</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <label>Agama</label>
                    <div class="mb-3 row">
                        <div class="col-sm-10">
                            <select class="form-control" name="agama_dokter" required>
                                <option value="">- Pilih -</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Khonghucu">Khonghucu</option>
                            </select>
                        </div>
                    </div>
                    <br>

                    <label>Status Pernikahan</label>
                    <div class="mb-3 row">
                        <div class="col-sm-10">
                            <select class="form-control" name="status_pernikahan_dokter" required>
                                <option value="">- Pilih -</option>
                                <option value="Sudah Menikah">Sudah Menikah</option>
                                <option value="Belum Menikah">Belum Menikah</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <label>Spesialis Dokter</label>
                    <input type="text" name="status_dokter" placeholder="Spesialis" class="form-control" required>
                    <br>
                    <br>
                    <label>Alamat</label>
                    <input type="text" name="alamat_dokter" placeholder="Alamat" class="form-control" required>
                    <br>
                    <br>
                    <label>Nomor HP</label>
                    <input type="text" name="no_hp_dokter" placeholder="Nomor HP" class="form-control" required>
                    <br>
                    <br>
                    <label>Tempat Tanggal Lahir</label>
                    <input type="text" name="ttl_dokter" placeholder="Tempat Tanggal Lahir" class="form-control" required>
                    <br>
                    <br>
                    <label>Password</label>
                    <input type="text" name="password_dokter" placeholder="Password" class="form-control" required>
                    <br>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" name="addnewdokter">Tambah</button>
                </div>
            </form>

        </div>
    </div>
</div>