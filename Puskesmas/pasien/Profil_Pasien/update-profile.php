<!-- Form untuk mengedit profil pasien -->
<form action="" method="POST" enctype="multipart/form-data">
  <!-- Input Gambar Profil -->
  <div class="row mb-3">
    <label class="col-md-4 col-lg-3 col-form-label">Gambar Profile</label>
    <div class="col-md-8 col-lg-9">
      <input type="file" name="foto_pasien" id="foto_pasien" class="form-control-file" accept="image/*">
      <br>
      <small class="form-text text-muted">Upload file image (jpg, jpeg, png)</small>
      <br>
      <img id="preview_gambar" src="../../adm/Kelola_Pasien/img/<?= $foto_pasien; ?>" alt="<?= $foto_pasien; ?>" height="100" width="100">
    </div>
  </div>

  <!-- Input Jenis Kelamin -->
  <div class="row mb-3">
    <label class="col-md-4 col-lg-3 col-form-label">Jenis Kelamin<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <select class="form-control form-select" name="jk_pasien" required>
        <option disabled selected>Pilih jenis kelamin</option>
        <option value="Laki-Laki" <?= $jk_pasien === 'Laki-Laki' ? 'selected' : '' ?>>Laki-Laki</option>
        <option value="Perempuan" <?= $jk_pasien === 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
      </select>
    </div>
  </div>

  <!-- Input Tempat Lahir -->
  <div class="row mb-3">
    <label class="col-md-4 col-lg-3 col-form-label">Tempat Lahir<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input name="tempat_lahir_pasien" type="text" class="form-control" value="<?= $tempat_lahir_pasien; ?>" required maxlength="50">
    </div>
  </div>

  <!-- Input Tanggal Lahir -->
  <div class="row mb-3">
    <label class="col-md-4 col-lg-3 col-form-label">Tanggal Lahir<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input name="tgl_lahir_pasien" type="date" class="form-control" id="tglLahirPasien" value="<?= $tgl_lahir_pasien; ?>" required>
    </div>
  </div>

  <!-- Input Agama -->
  <div class="row mb-3">
    <label class="col-md-4 col-lg-3 col-form-label">Agama<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <select class="form-control form-select" name="agama_pasien" required>
        <option disabled selected>Pilih agama</option>
        <?php
        $agama_list = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu'];
        foreach ($agama_list as $agama) {
          $selected = ($agama_pasien === $agama) ? 'selected' : '';
          echo "<option value='$agama' $selected>$agama</option>";
        }
        ?>
      </select>
    </div>
  </div>

  <!-- Input Status Pernikahan -->
  <div class="row mb-3">
    <label class="col-md-4 col-lg-3 col-form-label">Status Pernikahan<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <select class="form-control form-select" name="status_pernikahan_pasien" required>
        <option disabled selected>Pilih status</option>
        <?php
        $status_list = ['Sudah Menikah', 'Belum Menikah', 'Janda/Duda'];
        foreach ($status_list as $status) {
          $selected = ($status_pernikahan_pasien === $status) ? 'selected' : '';
          echo "<option value='$status' $selected>$status</option>";
        }
        ?>
      </select>
    </div>
  </div>

  <!-- Input Pekerjaan -->
  <div class="row mb-3">
    <label class="col-md-4 col-lg-3 col-form-label">Pekerjaan<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input name="pekerjaan_pasien" type="text" class="form-control" value="<?= $pekerjaan_pasien; ?>" required maxlength="100">
    </div>
  </div>

  <!-- Input Riwayat Alergi -->
  <div class="row mb-3">
    <label class="col-md-4 col-lg-3 col-form-label">Riwayat Alergi<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input name="riwayat_alergi_pasien" type="text" class="form-control" value="<?= $riwayat_alergi_pasien; ?>" required maxlength="100">
    </div>
  </div>

  <!-- Input Alamat -->
  <div class="row mb-3">
    <label class="col-md-4 col-lg-3 col-form-label">Alamat<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input name="alamat_pasien" type="text" class="form-control" value="<?= $alamat_pasien; ?>" required maxlength="100">
    </div>
  </div>

  <!-- Input Nomor HP -->
  <div class="row mb-3">
    <label class="col-md-4 col-lg-3 col-form-label">Nomor HP<span class="text-danger">*</span></label>
    <div class="col-md-8 col-lg-9">
      <input
        name="no_hp_pasien"
        type="text"
        class="form-control"
        id="noHpPasien"
        placeholder="No.HP/Whatsapp Aktif"
        maxlength="14"
        inputmode="numeric"
        pattern="08\d{8,12}"
        value="<?= $no_hp_pasien; ?>"
        required>
      <div class="invalid-feedback">Nomor HP harus dimulai dengan 08 dan terdiri dari 10 hingga 14 digit angka.</div>
    </div>
  </div>

  <!-- Input Password Baru -->
  <div class="row mb-3">
    <label class="col-md-4 col-lg-3 col-form-label">Password Baru</label>
    <div class="col-md-8 col-lg-9">
      <input
        type="password"
        name="password_pasien"
        id="password_pasien"
        class="form-control"
        minlength="8"
        maxlength="20"
        placeholder="Isi jika ingin mengganti password">
      <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password.</small>
    </div>
  </div>

  <!-- Tampilkan Password -->
  <div class="row mb-3">
    <div class="col-md-8 offset-md-4 col-lg-9 offset-lg-3">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="showPassword">
        <label class="form-check-label" for="showPassword">Tampilkan Password</label>
      </div>
    </div>
  </div>

  <div class="text-center">
    <input type="hidden" name="idps" value="<?= $idps; ?>">
    <button type="submit" class="btn btn-primary" name="updatepasien">Simpan Perubahan</button>
  </div>
</form>

<script>
  // Preview gambar profil
  document.getElementById('foto_pasien').addEventListener('change', function(event) {
    const input = event.target;
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('preview_gambar').src = e.target.result;
      }
      reader.readAsDataURL(input.files[0]);
    }
  });

  // Validasi Nomor HP
  const noHpInput = document.getElementById("noHpPasien");
  noHpInput.addEventListener("input", function() {
    this.value = this.value.replace(/\D/g, '');
    const valid = /^08\d{8,12}$/.test(this.value);

    if (this.value.length >= 10) {
      if (!valid) {
        this.classList.add("is-invalid");
      } else {
        this.classList.remove("is-invalid");
        this.classList.add("is-valid");
      }
    } else {
      this.classList.remove("is-invalid", "is-valid");
    }
  });

  // Tampilkan/sembunyikan password
  document.getElementById("showPassword").addEventListener("change", function() {
    const type = this.checked ? "text" : "password";
    document.getElementById("password_pasien").type = type;
  });

  // Batasi input tanggal lahir maksimal hari ini
  const inputTanggalLahir = document.getElementById("tglLahirPasien");
  const today = new Date().toISOString().split("T")[0];
  inputTanggalLahir.setAttribute("max", today);

  // Validasi tahun lahir tidak boleh melebihi tahun ini
  document.querySelector("form").addEventListener("submit", function(event) {
    const tahunLahir = new Date(inputTanggalLahir.value).getFullYear();
    const tahunSekarang = new Date().getFullYear();
    if (tahunLahir > tahunSekarang) {
      alert("Tahun lahir tidak boleh melebihi tahun ini.");
      event.preventDefault();
    }
  });
</script>