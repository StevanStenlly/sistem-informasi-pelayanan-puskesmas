                <!-- Update Modal -->
                <div class="modal fade" id="update<?= $idps; ?>">
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
                                    <label>Foto Pasien</label>
                                    <input type="file" name="foto_pasien" value="<?= $foto_pasien; ?>" class="form-control-file">
                                    <br>
                                    <small id="fileHelpId" class="form-text text-muted">Upload file image (jpg,jpeg,png)</small>
                                    <br>
                                    <img src="img/<?php echo $foto_pasien; ?>" alt="<?php echo $foto_pasien; ?>" height="100" width="100">
                                    <br>

                                    <label>Nomor Kartu Pasien</label>
                                    <input type="text" name="no_kartu_pasien" value="<?= $no_kartu_pasien; ?>" placeholder="Nomor Kartu" class="form-control">
                                    <br>

                                    <label>NIK</label>
                                    <input type="text" name="nik_pasien" value="<?= $idps; ?>" placeholder="NIK" class="form-control">
                                    <br>
                                    <label>Nama</label>
                                    <input type="text" name="nama_pasien" value="<?= $nama_pasien; ?>" placeholder="Nama" class="form-control">
                                    <br>

                                    <label>Jenis Kelamin</label>
                                    <div class="mb-3 row">
                                        <div class="col-sm-10">
                                            <select class="form-control" name="jk_pasien">
                                                <option value="<?= $jk_pasien; ?>"><?php echo $data['jk_pasien']; ?></option>
                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <label>Agama</label>
                                    <div class="mb-3 row">
                                        <div class="col-sm-10">
                                            <select class="form-control" name="agama_pasien">
                                                <option value="<?= $agama_pasien; ?>"><?php echo $data['agama_pasien']; ?></option>
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
                                            <select class="form-control" name="status_pernikahan_pasien">
                                                <option value="<?= $status_pernikahan_pasien; ?>"><?php echo $data['status_pernikahan_pasien']; ?></option>
                                                <option value="Sudah Menikah">Sudah Menikah</option>
                                                <option value="Belum Menikah">Belum Menikah</option>
                                                <option value="Janda/Duda">Janda/Duda</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>

                                    <label>Alamat</label>
                                    <input type="text" name="alamat_pasien" value="<?= $alamat_pasien; ?>" placeholder="Alamat" class="form-control">
                                    <br>
                                    <br>
                                    <label>Nomor HP</label>
                                    <input type="text" name="no_hp_pasien" value="<?= $no_hp_pasien; ?>" placeholder="Nomor HP" class="form-control">

                                    <br>
                                    <label>Tempat Tanggal Lahir</label>
                                    <input type="text" name="ttl_pasien" value="<?= $ttl_pasien; ?>" placeholder="Tempat Tanggal Lahir" class="form-control">
                                    <br>

                                    <label>Pekerjaan</label>
                                    <input type="text" name="pekerjaan_pasien" value="<?= $pekerjaan_pasien; ?>" placeholder="Pekerjaan" class="form-control">
                                    <br>

                                    <label>Riwayat Alergi</label>
                                    <input type="text" name="riwayat_alergi_pasien" value="<?= $riwayat_alergi_pasien; ?>" placeholder="Riwayat Alergi" class="form-control">
                                    <br>

                                    <label>Password</label>
                                    <input type="text" name="password_pasien" value="<?= $password_pasien; ?>" placeholder="Password" class="form-control">
                                    <br>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <input type="hidden" name="idps" value="<?= $idps; ?>">
                                    <button type="submit" class="btn btn-primary" name="updatepasien">Perbarui</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>