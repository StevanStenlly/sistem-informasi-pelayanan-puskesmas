<!-- Profile Edit Form -->
<form action="" method="POST" enctype="multipart/form-data">
  <div class="row mb-3">
    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Gambar Profile</label>
    <div class="col-md-8 col-lg-9">
      <input type="file" name="foto_petugas" value="<?= $foto_petugas; ?>" class="form-control-file">
      <br>
      <small id="fileHelpId" class="form-text text-muted">Upload file image (jpg,jpeg,png)</small>
      <br>
      <img src="img/<?= $foto_petugas; ?>" alt="<?= $foto_petugas; ?>" height="100" width="100">

    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input name="nama_petugas" type="text" class="form-control" id="fullName" value="<?= $nama_petugas; ?>">
    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">NIP<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input name="nip_petugas" type="text" class="form-control" id="fullName" value="<?= $nip_petugas; ?>">
    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Jenis Kelamin<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <select class="form-control form-select" name="jk_petugas">
        <option value="<?= $jk_petugas; ?>"><?= $jk_petugas; ?></option>
        <option value="Laki-Laki">Laki-Laki</option>
        <option value="Perempuan">Perempuan</option>
      </select>
    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Tempat Lahir<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input name="tempat_lahir_petugas" type="text" class="form-control" id="fullName" value="<?= $tempat_lahir_petugas; ?>" required>
    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Tanggal Lahir<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input name="tgl_lahir_petugas" type="date" class="form-control" id="fullName" value="<?= $tgl_lahir_petugas; ?>" required>
    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Agama<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <select class="form-control form-select" name="agama_petugas">
        <option value="<?= $agama_petugas; ?>"><?= $agama_petugas; ?></option>
        <option value="Islam">Islam</option>
        <option value="Kristen">Kristen</option>
        <option value="Katolik">Katolik</option>
        <option value="Hindu">Hindu</option>
        <option value="Buddha">Buddha</option>
        <option value="Khonghucu">Khonghucu</option>
      </select>
    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Status Pernikahan<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <select class="form-control form-select" name="status_pernikahan_petugas">
        <option value="<?= $status_pernikahan_petugas; ?>"><?= $status_pernikahan_petugas; ?></option>
        <option value="Sudah Menikah">Sudah Menikah</option>
        <option value="Belum Menikah">Belum Menikah</option>
        <option value="Janda/Duda">Janda/Duda</option>
      </select>
    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Ruang Pelayanan<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <select class="form-control form-select" name="id_ruang">

        <?php
        $ambilsemuaruang = mysqli_query($conn, "SELECT * FROM petugas a left join ruang c on a.id_ruang=c.id_ruang WHERE nip_petugas = '$detail' ");
        while ($data = mysqli_fetch_array($ambilsemuaruang)) {
        ?>
          <option value="<?php echo $data['id_ruang']; ?>"><?php echo $data['nama_ruang']; ?></option>
        <?php
        };
        ?>
        <option value=" "> </option>
        <option value="5">Ruang Screening</option>
        <option value="6">Ruang Apoteker</option>
      </select>
    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Alamat<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input name="alamat_petugas" type="text" class="form-control" id="fullName" value="<?= $alamat_petugas; ?>">
    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nomor HP<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input name="no_hp_petugas" type="text" class="form-control" id="fullName" value="<?= $no_hp_petugas; ?>">
    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Password<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input name="password_petugas" type="text" class="form-control" id="fullName" value="<?= $password_petugas; ?>">
    </div>
  </div>

  <div class="text-center">
    <input type="hidden" name="nip_petugas" value="<?= $nip_petugas; ?>">
    <button type="submit" class="btn btn-primary" name="updatepetugas">Simpan Perubahan</button>
  </div>
</form><!-- End Profile Edit Form -->

</div>