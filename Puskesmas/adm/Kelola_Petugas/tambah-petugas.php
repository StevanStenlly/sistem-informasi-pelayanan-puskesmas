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
                    <label>Foto<span class="text-danger">*</span></label>
                    <br>
                    <input type="file" name="foto_petugas" class="form-control-file" required>
                    <br>
                    <small id="fileHelpId" class="form-text text-muted">Upload file image (jpg,jpeg,png)</small>
                    <br>
                    <br>
                    <label>NIP<span class="text-danger">*</span></label>
                    <input type="text" name="nip_petugas" placeholder="NIP" class="form-control" maxlength="16" required>
                    <br>
                    <label>Nama<span class="text-danger">*</span></label>
                    <input type="text" name="nama_petugas" placeholder="Nama" class="form-control" required>
                    <br>

                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Ruang Pelayanan<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                        <select class="form-control form-select" name="id_ruang" required>
                            <option value=" "> </option>
                            <option value="5">Ruang Screening</option>
                            <option value="6">Ruang Apoteker</option>
                        </select>
                    </div>
                    <br>
                    <label>Tempat Lahir<span class="text-danger">*</span></label>
                    <input type="text" name="tempat_lahir_petugas" placeholder="Nama" class="form-control" required>
                    <br>
                    <br>
                    <label>Tanggal Lahir<span class="text-danger">*</span></label>
                    <input type="date" name="tgl_lahir_petugas" placeholder="Nama" class="form-control" required>
                    <br>
                    <label>Jenis Kelamin<span class="text-danger">*</span></label>
                    <div class="mb-3 row">
                        <div class="col-sm-10">
                            <select class="form-control form-select" name="jk_petugas" required>
                                <option value="">- Pilih -</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <label>Agama<span class="text-danger">*</span></label>
                    <div class="mb-3 row">
                        <div class="col-sm-10">
                            <select class="form-control form-select" name="agama_petugas" required>
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
                    <br>
                    <label>Alamat<span class="text-danger">*</span></label>
                    <input type="text" name="alamat_petugas" placeholder="Alamat" class="form-control" required>
                    <br>
                    <br>
                    <label>Nomor HP<span class="text-danger">*</span></label>
                    <input type="text" name="no_hp_petugas" placeholder="Nomor HP" class="form-control" required>
                    <br>
                    <br>
                    <label>Password<span class="text-danger">*</span></label>
                    <input type="text" name="password_petugas" placeholder="Password" class="form-control" required>
                    <br>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" name="addnewpetugas">Tambah</button>
                </div>
            </form>

        </div>
    </div>
</div>