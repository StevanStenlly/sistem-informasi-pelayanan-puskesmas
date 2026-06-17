<!-- Profile Edit Form -->
<form action="" method="POST" enctype="multipart/form-data">
  <div class="row mb-3">
    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Gambar Profile</label>
    <div class="col-md-8 col-lg-9">
      <input type="file" name="foto_dokter" value="<?= $foto_dokter; ?>" class="form-control-file">
      <br>
      <small id="fileHelpId" class="form-text text-muted">Upload file image (jpg,jpeg,png)</small>
      <br>
      <img src="img/<?= $foto_dokter; ?>" alt="<?= $foto_dokter; ?>" height="100" width="100">

    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input name="nama_dokter" type="text" class="form-control" id="fullName" value="<?= $nama_dokter; ?>">
    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">NIP<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input name="nip_dokter" type="text" class="form-control" id="fullName" value="<?= $nip_dokter; ?>">
    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Jenis Kelamin<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <select class="form-control form-select" name="jk_dokter">
        <option value="<?= $jk_dokter; ?>"><?= $jk_dokter; ?></option>
        <option value="Laki-Laki">Laki-Laki</option>
        <option value="Perempuan">Perempuan</option>
      </select>
    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Tempat Lahir<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input name="tempat_lahir_dokter" type="text" class="form-control" id="fullName" value="<?= $tempat_lahir_dokter; ?>" required>
    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Tanggal Lahir<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input name="tgl_lahir_dokter" type="date" class="form-control" id="fullName" value="<?= $tgl_lahir_dokter; ?>" required>
    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Agama<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <select class="form-control form-select" name="agama_dokter">
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
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Status Pernikahan<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <select class="form-control form-select" name="status_pernikahan_dokter">
        <option value="<?= $status_pernikahan_dokter; ?>"><?= $status_pernikahan_dokter; ?></option>
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
        $ambilsemuaruang = mysqli_query($conn, "SELECT * FROM dokter a left join ruang c on a.id_ruang=c.id_ruang WHERE nip_dokter = '$detail' ");
        while ($data = mysqli_fetch_array($ambilsemuaruang)) {
        ?>
          <option value="<?php echo $data['id_ruang']; ?>"><?php echo $data['nama_ruang']; ?></option>
        <?php
        };
        ?>

        <option value=" "> </option>
        <option value="1">Ruang Pemeriksaan Umum</option>
        <option value="2">Ruang Pemeriksaan KIA-KB</option>
        <option value="3">Ruang Pemeriksaan Gigi</option>
        <option value="4">Ruang Pemeriksaan ILI</option>
      </select>
    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Alamat<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input name="alamat_dokter" type="text" class="form-control" id="fullName" value="<?= $alamat_dokter; ?>">
    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nomor HP<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input name="no_hp_dokter" type="text" class="form-control" id="fullName" value="<?= $no_hp_dokter; ?>">
    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Password<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input name="password_dokter" type="text" class="form-control" id="fullName" value="<?= $password_dokter; ?>">
    </div>
  </div>

  <div class="text-center">
    <input type="hidden" name="nip_dokter" value="<?= $nip_dokter; ?>">
    <button type="submit" class="btn btn-primary" name="updatedokter">Simpan Perubahan</button>
  </div>
</form><!-- End Profile Edit Form -->