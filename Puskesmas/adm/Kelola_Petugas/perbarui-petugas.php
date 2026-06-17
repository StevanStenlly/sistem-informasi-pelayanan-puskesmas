     <!-- Update Modal -->
     <div class="modal fade" id="update<?= $nip_petugas; ?>">
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
                         <label>Foto Petugas</label>
                         <input type="file" name="foto_petugas" value="<?= $foto_petugas; ?>" class="form-control-file">
                         <br>
                         <small id="fileHelpId" class="form-text text-muted">Upload file image (jpg,jpeg,png)</small>
                         <br>
                         <img src="img/<?php echo $foto_petugas; ?>" alt="<?php echo $foto_petugas; ?>" height="100" width="100">
                         <br>
                         <br>
                         <label>NIP</label>
                         <input type="text" name="nip_petugas" value="<?= $nip_petugas; ?>" placeholder="NIP" class="form-control" maxlength="16">
                         <br>
                         <label>Nama</label>
                         <input type="text" name="nama_petugas" value="<?= $nama_petugas; ?>" placeholder="Nama" class="form-control">
                         <br>

                         <label>Jenis Kelamin</label>
                         <div class="mb-3 row">
                             <div class="col-sm-10">
                                 <select class="form-control" name="jk_petugas">
                                     <option value="<?= $jk_petugas; ?>"><?php echo $data['jk_petugas']; ?></option>
                                     <option value="Laki-Laki">Laki-Laki</option>
                                     <option value="Perempuan">Perempuan</option>
                                 </select>
                             </div>
                         </div>

                         <label>Agama</label>
                         <div class="mb-3 row">
                             <div class="col-sm-10">
                                 <select class="form-control" name="agama_petugas">
                                     <option value="<?= $agama_petugas; ?>"><?php echo $data['agama_petugas']; ?></option>
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
                                 <select class="form-control" name="status_pernikahan_petugas">
                                     <option value="<?= $status_pernikahan_petugas; ?>"><?php echo $data['status_pernikahan_petugas']; ?></option>
                                     <option value="Sudah Menikah">Sudah Menikah</option>
                                     <option value="Belum Menikah">Belum Menikah</option>
                                     <option value="Janda/Duda">Janda/Duda</option>
                                 </select>
                             </div>
                         </div>
                         <br>

                         <label>Spesialis petugas</label>
                         <input type="text" name="status_petugas" value="<?= $status_petugas; ?>" placeholder="Spesialis petugas" class="form-control">
                         <br>
                         <br>
                         <label>Alamat</label>
                         <input type="text" name="alamat_petugas" value="<?= $alamat_petugas; ?>" placeholder="Alamat" class="form-control">
                         <br>
                         <br>
                         <label>Nomor HP</label>
                         <input type="text" name="no_hp_petugas" value="<?= $no_hp_petugas; ?>" placeholder="Nomor HP" class="form-control">
                         <br>
                         <br>
                         <label>Tempat Tanggal Lahir</label>
                         <input type="text" name="ttl_petugas" value="<?= $ttl_petugas; ?>" placeholder="Tempat Tanggal Lahir" class="form-control">
                         <br>
                         <br>
                         <label>Password</label>
                         <input type="text" name="password_petugas" value="<?= $password_petugas; ?>" placeholder="Password" class="form-control">
                         <br>
                     </div>

                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                         <input type="hidden" name="nip_petugas" value="<?= $nip_petugas; ?>">
                         <button type="submit" class="btn btn-primary" name="updatepetugas">Perbarui</button>
                     </div>
                 </form>

             </div>
         </div>
     </div>