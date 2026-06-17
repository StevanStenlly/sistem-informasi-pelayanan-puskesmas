<!-- Profile Edit Form -->
<form action="" method="POST" enctype="multipart/form-data">
  <div class="row mb-3">
    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Gambar Profile</label>
    <div class="col-md-8 col-lg-9">
      <input type="file" name="foto_dokter" value="<?= $foto_dokter; ?>" class="form-control-file">
      <br>
      <small id="fileHelpId" class="form-text text-muted">Upload file image (jpg,jpeg,png)</small>
      <br>
      <img src="../../adm/Kelola_Dokter/img/<?php echo $data['foto_dokter']; ?>" alt="<?php echo $data['foto_dokter']; ?>" height="100" width="100">

    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Jenis Kelamin</label>
    <div class="col-md-8 col-lg-9">
      <select class="form-control" name="jk_dokter">
        <option value="<?= $jk_dokter; ?>"><?= $jk_dokter; ?></option>
        <option value="Laki-Laki">Laki-Laki</option>
        <option value="Perempuan">Perempuan</option>
      </select>
    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Tempat Lahir</label>
    <div class="col-md-8 col-lg-9">
      <input name="tempat_lahir_dokter" type="text" class="form-control" id="fullName" value="<?= $tempat_lahir_dokter; ?>" required>
    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Tanggal Lahir</label>
    <div class="col-md-8 col-lg-9">
      <input name="tgl_lahir_dokter" type="date" class="form-control" id="fullName" value="<?= $tgl_lahir_dokter; ?>" required>
    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Agama</label>
    <div class="col-md-8 col-lg-9">
      <select class="form-control" name="agama_dokter">
        <option value="<?= $agama_dokter; ?>"><?= $agama_dokter; ?></option>
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
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Status Pernikahan</label>
    <div class="col-md-8 col-lg-9">
      <select class="form-control" name="status_pernikahan_dokter">
        <option value="<?= $status_pernikahan_dokter; ?>"><?= $status_pernikahan_dokter; ?></option>
        <option value="Sudah Menikah">Sudah Menikah</option>
        <option value="Belum Menikah">Belum Menikah</option>
        <option value="Janda/Duda">Janda/Duda</option>
      </select>
    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
    <div class="col-md-8 col-lg-9">
      <input name="alamat_dokter" type="text" class="form-control" id="fullName" value="<?= $alamat_dokter; ?>">
    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nomor HP</label>
    <div class="col-md-8 col-lg-9">
      <input name="no_hp_dokter" type="text" class="form-control" id="fullName" value="<?= $no_hp_dokter; ?>">
    </div>
  </div>

  <div class="text-center">
    <input type="hidden" name="idd" value="<?= $idd; ?>">
    <button type="submit" class="btn btn-primary" name="updatedokter">Simpan Perubahan</button>
  </div>
</form><!-- End Profile Edit Form -->